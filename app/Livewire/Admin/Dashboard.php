<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Services\TenantManager;
use Carbon\Carbon;

class Dashboard extends Component
{
    public function render()
    {
        $tenantId = TenantManager::getTenantId();

        // 1. Pelanggan Stats
        $totalPelanggan = Pelanggan::where('tenant_id', $tenantId)->count();
        $pelangganAktif = Pelanggan::where('tenant_id', $tenantId)->where('status', 'aktif')->count();
        $pelangganSosial = Pelanggan::where('tenant_id', $tenantId)->where('jenis_pelanggan', 'sosial')->count();
        $pelangganIndustri = Pelanggan::where('tenant_id', $tenantId)->where('jenis_pelanggan', 'industri')->count();
        
        // 2. Keuangan (Bulan Ini)
        $m = date('m');
        $y = date('Y');
        
        $pemasukanBulanIni = Pemasukan::where('tenant_id', $tenantId)->whereMonth('tanggal', $m)->whereYear('tanggal', $y)->sum('nominal');
        $pengeluaranBulanIni = Pengeluaran::where('tenant_id', $tenantId)->whereMonth('tanggal', $m)->whereYear('tanggal', $y)->sum('nominal');
        
        // Saldo Kas All Time
        $totalPemasukan = Pemasukan::where('tenant_id', $tenantId)->sum('nominal');
        $totalPengeluaran = Pengeluaran::where('tenant_id', $tenantId)->sum('nominal');
        $saldoKas = $totalPemasukan - $totalPengeluaran;

        $subsidiSosial = Tagihan::where('tenant_id', $tenantId)->whereMonth('created_at', $m)->sum('subsidi');
        
        // 3. Tagihan (Piutang Keseluruhan)
        $totalPiutang = Tagihan::where('tenant_id', $tenantId)->where('status', 'belum_bayar')->sum('total');
        $bulanIniBelumBayar = Tagihan::where('tenant_id', $tenantId)->where('status', 'belum_bayar')->whereMonth('created_at', $m)->whereYear('created_at', $y)->sum('total');

        // 4. Data untuk Chart (6 Bulan Terakhir)
        $chartLabels = [];
        $chartPemasukan = [];
        $chartPengeluaran = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $chartLabels[] = $date->translatedFormat('M Y');
            
            $chartPemasukan[] = Pemasukan::where('tenant_id', $tenantId)
                ->whereMonth('tanggal', $date->month)
                ->whereYear('tanggal', $date->year)
                ->sum('nominal');
                
            $chartPengeluaran[] = Pengeluaran::where('tenant_id', $tenantId)
                ->whereMonth('tanggal', $date->month)
                ->whereYear('tanggal', $date->year)
                ->sum('nominal');
        }

        return view('livewire.admin.dashboard', compact(
            'totalPelanggan', 'pelangganAktif', 'pelangganSosial', 'pelangganIndustri',
            'pemasukanBulanIni', 'pengeluaranBulanIni', 'saldoKas', 'subsidiSosial',
            'totalPiutang', 'bulanIniBelumBayar',
            'chartLabels', 'chartPemasukan', 'chartPengeluaran'
        ))->layout('components.layouts.admin', ['header' => 'Dashboard Utama']);
    }
}
