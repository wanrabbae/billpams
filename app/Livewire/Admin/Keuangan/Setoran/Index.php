<?php

namespace App\Livewire\Admin\Keuangan\Setoran;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Setoran;
use App\Models\Pemasukan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination;

    public $filterStatus = ''; // '' = semua, 'menunggu_konfirmasi', 'diterima'

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function terimaSetoran($id)
    {
        DB::beginTransaction();
        try {
            $setoran = Setoran::where('id', $id)
                              ->where('status', 'menunggu_konfirmasi')
                              ->lockForUpdate()
                              ->firstOrFail();

            // 1. Update status setoran
            $setoran->update([
                'status' => 'diterima'
            ]);

            // 2. Buat record Pemasukan Kas HIPPAMS
            Pemasukan::create([
                'tenant_id' => $setoran->tenant_id,
                'tanggal' => now(),
                'kategori' => 'Pendapatan Air',
                'sumber' => 'Setoran Tunai: ' . $setoran->petugas->name,
                'nominal' => $setoran->total_setoran,
                'bukti' => 'Sistem - ID Setoran: ' . $setoran->id,
                'user_id' => Auth::id(), // Bendahara yang menerima
            ]);

            DB::commit();
            session()->flash('success', 'Setoran berhasil diterima dan masuk ke Kas HIPPAMS.');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $query = Setoran::with('petugas')->orderBy('created_at', 'desc');

        if ($this->filterStatus) {
            $query->where('status', $this->filterStatus);
        }

        $setorans = $query->paginate(15);

        return view('livewire.admin.keuangan.setoran.index', compact('setorans'))
               ->layout('components.layouts.admin', ['header' => 'Validasi Setoran Kasir']);
    }
}
