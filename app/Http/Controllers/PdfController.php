<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Tenant;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Services\TenantManager;

class PdfController extends Controller
{
    public function suratPenagihan(Request $request, $pelangganId, $jenis)
    {
        $pelanggan = Pelanggan::with(['tagihans' => function($q) {
            $q->where('status', 'belum_bayar')->orderBy('periode', 'asc');
        }])->findOrFail($pelangganId);

        // Security check
        if ($pelanggan->tenant_id != TenantManager::getTenantId()) {
            abort(403, 'Unauthorized');
        }

        $tenant = Tenant::find($pelanggan->tenant_id);

        $tunggakanBulan = $pelanggan->tagihans->count();
        $totalTunggakan = $pelanggan->tagihans->sum('total');

        if ($jenis === 'teguran' && $tunggakanBulan < 2) {
            abort(400, 'Syarat Surat Teguran belum terpenuhi (min 2 bulan).');
        }

        if ($jenis === 'pencabutan' && $tunggakanBulan < 3) {
            abort(400, 'Syarat Surat Pencabutan belum terpenuhi (min 3 bulan).');
        }

        $data = [
            'tenant' => $tenant,
            'pelanggan' => $pelanggan,
            'jenis' => $jenis,
            'tunggakan_bulan' => $tunggakanBulan,
            'total_tunggakan' => $totalTunggakan,
            'tanggal' => now()->format('d F Y'),
            'nomor_surat' => ($jenis === 'teguran' ? 'ST' : 'SP') . '/' . date('Y/m') . '/' . str_pad($pelanggan->id, 4, '0', STR_PAD_LEFT)
        ];

        $pdf = Pdf::loadView('pdf.surat-penagihan', $data);
        
        return $pdf->stream('Surat_' . ucfirst($jenis) . '_' . $pelanggan->kode_pelanggan . '.pdf');
    }
}
