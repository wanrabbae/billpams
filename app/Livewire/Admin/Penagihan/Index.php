<?php

namespace App\Livewire\Admin\Penagihan;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Pelanggan;

class Index extends Component
{
    use WithPagination;

    public $filterTunggakan = ''; // 1, 2, 3

    public function updatingFilterTunggakan()
    {
        $this->resetPage();
    }

    public function render()
{
    // Cari pelanggan yang punya tagihan belum bayar,
    // hitung jumlah bulan menunggak dan total nominalnya.
    $query = Pelanggan::whereHas('tagihans', function ($q) {
            $q->where('status', 'belum_bayar');
        })
        ->withCount([
            'tagihans as tunggakan_count' => function ($q) {
                $q->where('status', 'belum_bayar');
            }
        ])
        ->withSum([
            'tagihans as total_tunggakan' => function ($q) {
                $q->where('status', 'belum_bayar');
            }
        ], 'total');

    if ($this->filterTunggakan === '1') {
        $query->having('tunggakan_count', 1);
    } elseif ($this->filterTunggakan === '2') {
        $query->having('tunggakan_count', 2);
    } elseif ($this->filterTunggakan === '3') {
        $query->having('tunggakan_count', '>=', 3);
    }

    $pelanggans = $query
        ->orderBy('tunggakan_count', 'desc')
        ->paginate(15);

    return view(
        'livewire.admin.penagihan.index',
        compact('pelanggans')
    )->layout(
        'components.layouts.admin',
        ['header' => 'Monitoring Piutang']
    );
}
}
