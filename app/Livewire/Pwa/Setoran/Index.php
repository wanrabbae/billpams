<?php

namespace App\Livewire\Pwa\Setoran;

use Livewire\Component;
use App\Models\Pembayaran;
use App\Models\Setoran;
use App\Services\TenantManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Index extends Component
{
    public function render()
    {
        $petugasId = Auth::id();
        $tenantId = TenantManager::getTenantId();

        // Cari pembayaran yang belum disetor
        $unremitted = Pembayaran::where('tenant_id', $tenantId)
            ->where('petugas_id', $petugasId)
            ->whereNull('setoran_id')
            ->where('status', 'valid')
            ->get();

        $totalUnremitted = $unremitted->sum('nominal');
        $countUnremitted = $unremitted->count();

        // Cari histori setoran
        $riwayatSetoran = Setoran::where('tenant_id', $tenantId)
            ->where('petugas_id', $petugasId)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return view('livewire.pwa.setoran.index', compact('totalUnremitted', 'countUnremitted', 'riwayatSetoran'))
            ->layout('components.layouts.pwa', ['header' => 'Setoran Kas']);
    }

    public function buatSetoran()
    {
        $petugasId = Auth::id();
        $tenantId = TenantManager::getTenantId();

        DB::beginTransaction();
        try {
            $unremitted = Pembayaran::where('tenant_id', $tenantId)
                ->where('petugas_id', $petugasId)
                ->whereNull('setoran_id')
                ->where('status', 'valid')
                ->lockForUpdate()
                ->get();

            if ($unremitted->count() === 0) {
                session()->flash('error', 'Tidak ada uang tunai yang perlu disetorkan.');
                DB::rollBack();
                return;
            }

            $total = $unremitted->sum('nominal');

            $setoran = Setoran::create([
                'tenant_id' => $tenantId,
                'petugas_id' => $petugasId,
                'tanggal' => now(),
                'jumlah_transaksi' => $unremitted->count(),
                'total_penerimaan' => $total,
                'total_setoran' => $total, // Asumsi awal setor sama dengan penerimaan
                'selisih' => 0,
                'status' => 'menunggu_konfirmasi'
            ]);

            // Update pembayaran
            Pembayaran::whereIn('id', $unremitted->pluck('id'))
                ->update(['setoran_id' => $setoran->id]);

            DB::commit();
            session()->flash('success', 'Setoran berhasil diajukan ke Bendahara.');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
