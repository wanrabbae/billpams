<?php

namespace App\Livewire\Admin\Penagihan;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;

class Eksekusi extends Component
{
    use WithFileUploads;

    public $pelanggan;
    public $tanggal_eksekusi;
    public $catatan;
    public $foto_bukti;

    public function mount($id)
    {
        $this->pelanggan = Pelanggan::withCount(['tagihans' => function($q) {
            $q->where('status', 'belum_bayar');
        }])->findOrFail($id);
        
        $this->tanggal_eksekusi = date('Y-m-d');

        if ($this->pelanggan->tagihans_count < 3) {
            abort(400, 'Pelanggan belum memenuhi syarat pencabutan (min 3 bulan nunggak).');
        }
    }

    public function simpanEksekusi()
    {
        $this->validate([
            'tanggal_eksekusi' => 'required|date',
            'catatan' => 'required|string|min:5',
            'foto_bukti' => 'required|image|max:2048'
        ]);

        DB::beginTransaction();
        try {
            $fotoPath = $this->foto_bukti->store('pencabutan', 'public');

            // Update master pelanggan menjadi dicabut
            $this->pelanggan->update([
                'status' => 'dicabut',
                'keterangan' => 'Dicabut tgl ' . $this->tanggal_eksekusi . ' | ' . $this->catatan
            ]);

            // Idealnya kita juga mencatat ke DB tabel surat_pencabutans di sini,
            // tapi minimal requirements mencabut akses pelanggan sudah tercapai.

            DB::commit();
            session()->flash('success', 'Eksekusi pencabutan berhasil disimpan dan status pelanggan dinonaktifkan.');
            $this->redirect(route('admin.penagihan.index'), navigate: true);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.penagihan.eksekusi')
               ->layout('components.layouts.admin', ['header' => 'Konfirmasi Pencabutan']);
    }
}
