<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Models\Tenant;
use App\Services\TenantManager;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BukuKasExport;

class ReportController extends Controller
{
    private function getBukuKasData($bulan, $tahun)
    {
        $tenantId = TenantManager::getTenantId();
        
        $pemasukan = Pemasukan::where('tenant_id', $tenantId)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'M-'.$item->id,
                    'tanggal' => $item->tanggal,
                    'tipe' => 'Masuk',
                    'kategori' => $item->kategori,
                    'deskripsi' => $item->sumber,
                    'debit' => $item->nominal,
                    'kredit' => 0,
                    'created_at' => $item->created_at,
                    'petugas' => $item->user->name ?? '-'
                ];
            });

        $pengeluaran = Pengeluaran::where('tenant_id', $tenantId)
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal', $tahun)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'K-'.$item->id,
                    'tanggal' => $item->tanggal,
                    'tipe' => 'Keluar',
                    'kategori' => $item->kategori,
                    'deskripsi' => $item->keterangan,
                    'debit' => 0,
                    'kredit' => $item->nominal,
                    'created_at' => $item->created_at,
                    'petugas' => $item->user->name ?? '-'
                ];
            });

        $bukuKas = $pemasukan->concat($pengeluaran)->sortBy([
            ['tanggal', 'asc'],
            ['created_at', 'asc']
        ])->values();

        $saldoAwalPemasukan = Pemasukan::where('tenant_id', $tenantId)
            ->where(function($q) use ($bulan, $tahun) {
                $q->whereYear('tanggal', '<', $tahun)
                  ->orWhere(function($sq) use ($bulan, $tahun) {
                      $sq->whereYear('tanggal', $tahun)
                         ->whereMonth('tanggal', '<', $bulan);
                  });
            })->sum('nominal');

        $saldoAwalPengeluaran = Pengeluaran::where('tenant_id', $tenantId)
            ->where(function($q) use ($bulan, $tahun) {
                $q->whereYear('tanggal', '<', $tahun)
                  ->orWhere(function($sq) use ($bulan, $tahun) {
                      $sq->whereYear('tanggal', $tahun)
                         ->whereMonth('tanggal', '<', $bulan);
                  });
            })->sum('nominal');

        $saldoAwal = $saldoAwalPemasukan - $saldoAwalPengeluaran;

        $runningBalance = $saldoAwal;
        $bukuKas = $bukuKas->map(function ($item) use (&$runningBalance) {
            $runningBalance += $item['debit'] - $item['kredit'];
            $item['saldo'] = $runningBalance;
            return $item;
        });

        return [
            'saldoAwal' => $saldoAwal,
            'transaksi' => $bukuKas,
            'totalMasuk' => $pemasukan->sum('debit'),
            'totalKeluar' => $pengeluaran->sum('kredit'),
            'saldoAkhir' => $runningBalance,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'tenant' => Tenant::find($tenantId)
        ];
    }

    public function exportKasExcel(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));
        
        $data = $this->getBukuKasData($bulan, $tahun);
        
        return Excel::download(new BukuKasExport($data), 'Buku_Kas_'.$bulan.'_'.$tahun.'.xlsx');
    }

    public function exportKasPdf(Request $request)
    {
        $bulan = $request->get('bulan', date('m'));
        $tahun = $request->get('tahun', date('Y'));
        
        $data = $this->getBukuKasData($bulan, $tahun);
        
        $pdf = Pdf::loadView('pdf.buku-kas', $data)->setPaper('a4', 'landscape');
        return $pdf->stream('Buku_Kas_'.$bulan.'_'.$tahun.'.pdf');
    }
}
