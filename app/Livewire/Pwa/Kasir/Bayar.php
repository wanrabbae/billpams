<?php

namespace App\Livewire\Pwa\Kasir;

use Livewire\Component;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Tenant;
use App\Services\TenantManager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Bayar extends Component
{
    public $search = '';
    public $tagihan = null;
    public $uang_diterima = '';
    public $kembalian = 0;
    
    // Untuk cetak struk
    public $transaksiSukses = null;
    public $tenantName = '';
    public $tenantAddress = '';

    public function mount()
    {
        $tenant = Tenant::find(TenantManager::getTenantId());
        if ($tenant) {
            $this->tenantName = $tenant->name;
            $this->tenantAddress = $tenant->village . ', ' . $tenant->district;
        }
    }

    public function cariTagihan()
    {
        $this->validate([
            'search' => 'required|min:3'
        ]);

        // Cari tagihan berdasarkan kode pelanggan atau nama
        $this->tagihan = Tagihan::with(['pelanggan'])
            ->whereHas('pelanggan', function($q) {
                $q->where('kode_pelanggan', 'like', '%' . $this->search . '%')
                  ->orWhere('nama', 'like', '%' . $this->search . '%');
            })
            ->where('status', 'belum_bayar')
            ->orderBy('periode', 'asc')
            ->first(); // Prioritaskan tagihan paling lama

        if (!$this->tagihan) {
            session()->flash('error', 'Tagihan tidak ditemukan atau sudah LUNAS.');
        } else {
            $this->uang_diterima = $this->tagihan->total; // Default uang pas
            $this->hitungKembalian();
        }
        $this->transaksiSukses = null;
    }

    public function updatedUangDiterima()
    {
        $this->hitungKembalian();
    }

    private function hitungKembalian()
    {
        if ($this->tagihan) {
            $uang = (int) preg_replace('/\D/', '', $this->uang_diterima);
            $this->kembalian = max(0, $uang - $this->tagihan->total);
        }
    }

    public function prosesBayar()
    {
        $this->validate([
            'uang_diterima' => 'required|numeric'
        ]);

        $uang = (int) preg_replace('/\D/', '', $this->uang_diterima);
        if ($uang < $this->tagihan->total) {
            session()->flash('error', 'Uang diterima kurang dari total tagihan!');
            return;
        }

        DB::beginTransaction();
        try {
            // Generate Nomor Kwitansi HSU/YYYY/XXXXXX
            $year = date('Y');
            $prefix = 'HSU/' . $year . '/';
            $lastPembayaran = Pembayaran::where('nomor_kwitansi', 'like', $prefix . '%')
                                ->orderBy('id', 'desc')->lockForUpdate()->first();
            
            $nextUrut = $lastPembayaran ? ((int) substr($lastPembayaran->nomor_kwitansi, -6)) + 1 : 1;
            $noKwitansi = $prefix . str_pad($nextUrut, 6, '0', STR_PAD_LEFT);

            // Buat Pembayaran
            $pembayaran = Pembayaran::create([
                'tenant_id' => TenantManager::getTenantId(),
                'pelanggan_id' => $this->tagihan->pelanggan_id,
                'tagihan_id' => $this->tagihan->id,
                'nomor_kwitansi' => $noKwitansi,
                'tanggal' => now(),
                'nominal' => $this->tagihan->total,
                'uang_diterima' => $uang,
                'kembalian' => $this->kembalian,
                'metode_pembayaran' => 'tunai',
                'petugas_id' => Auth::id(),
                'status' => 'valid'
            ]);

            // Update Tagihan
            $this->tagihan->update(['status' => 'lunas']);

            DB::commit();

            // Setup Data untuk Struk Thermal
            $this->transaksiSukses = [
                'no_kwitansi' => $pembayaran->nomor_kwitansi,
                'tanggal' => \Carbon\Carbon::parse($pembayaran->tanggal)->format('d/m/Y H:i'),
                'petugas' => Auth::user()->name,
                'kode_plg' => $this->tagihan->pelanggan->kode_pelanggan,
                'nama_plg' => substr($this->tagihan->pelanggan->nama, 0, 20),
                'alamat_plg' => substr($this->tagihan->pelanggan->alamat, 0, 20),
                'jenis_plg' => strtoupper($this->tagihan->pelanggan->jenis_pelanggan),
                'periode' => date('F Y', strtotime($this->tagihan->periode)),
                'meter' => $this->tagihan->meter_awal . ' - ' . $this->tagihan->meter_akhir . ' m3',
                'pemakaian' => $this->tagihan->pemakaian . ' m3',
                'tarif' => 'Rp ' . number_format($this->tagihan->tarif_per_m3, 0, ',', '.'),
                'tagihan' => 'Rp ' . number_format($this->tagihan->total, 0, ',', '.'),
                'dibayar' => 'Rp ' . number_format($uang, 0, ',', '.'),
                'total' => 'Rp ' . number_format($this->tagihan->total, 0, ',', '.')
            ];

            // Trigger JS event for printing
            $this->dispatch('print-struk', strukData: $this->transaksiSukses, tenant: ['name' => $this->tenantName, 'address' => $this->tenantAddress]);
            
            $this->tagihan = null;
            $this->search = '';

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.pwa.kasir.bayar')->layout('components.layouts.pwa', ['header' => 'Kasir Pembayaran']);
    }
}
