<?php

namespace App\Livewire\Pwa\Pelanggan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pelanggan;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $filterJenis = 'semua'; // semua, umum, sosial, industri

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterJenis()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Pelanggan::query()
            ->when($this->filterJenis !== 'semua', function ($q) {
                return $q->where('jenis_pelanggan', $this->filterJenis);
            })
            ->when($this->search, function ($q) {
                return $q->where(function($sq) {
                    $sq->where('nama', 'like', '%' . $this->search . '%')
                       ->orWhere('kode_pelanggan', 'like', '%' . $this->search . '%')
                       ->orWhere('alamat', 'like', '%' . $this->search . '%');
                });
            });

        $pelanggans = $query->orderBy('nama', 'asc')->paginate(15);

        return view('livewire.pwa.pelanggan.index', compact('pelanggans'))
               ->layout('components.layouts.pwa', ['header' => 'Data Pelanggan']);
    }
}
