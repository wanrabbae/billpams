<?php

namespace App\Services;

use App\Models\Pelanggan;
use App\Models\Tarif;
use App\Models\Tagihan;
use App\Models\Meter;

class BillingEngineService
{
    /**
     * Hitung tagihan berdasarkan input meter
     */
    public static function calculateBilling(Meter $meter)
    {
        $pelanggan = $meter->pelanggan;
        $pemakaian = $meter->pemakaian;

        // Ambil tarif aktif terbaru untuk jenis pelanggan ini
        $tarif = Tarif::where('jenis_pelanggan', $pelanggan->jenis_pelanggan)
                      ->where('status', 'aktif')
                      ->orderBy('effective_date', 'desc')
                      ->first();

        if (!$tarif) {
            throw new \Exception("Tarif belum diatur untuk tipe pelanggan: {$pelanggan->jenis_pelanggan}");
        }

        $totalTagihan = 0;
        $subsidi = 0;

        if ($pelanggan->jenis_pelanggan === 'sosial') {
            $batasGratis = $tarif->batas_gratis ?? 15;
            
            if ($pemakaian <= $batasGratis) {
                $totalTagihan = 0;
                $subsidi = $pemakaian * $tarif->tarif;
            } else {
                $kelebihan = $pemakaian - $batasGratis;
                $totalTagihan = $kelebihan * $tarif->tarif_kelebihan;
                
                // Menghitung subsidi: berapa yang seharusnya dibayar (tarif normal) dikurangi yang aktual dibayar
                $seharusnyaBayar = $pemakaian * $tarif->tarif;
                $subsidi = $seharusnyaBayar - $totalTagihan;
            }
        } else {
            // Pelanggan Umum / Industri
            $totalTagihan = $pemakaian * $tarif->tarif;
        }

        return Tagihan::updateOrCreate(
            [
                'tenant_id' => $meter->tenant_id,
                'pelanggan_id' => $pelanggan->id,
                'periode' => $meter->periode,
            ],
            [
                'meter_awal' => $meter->meter_awal,
                'meter_akhir' => $meter->meter_akhir,
                'pemakaian' => $pemakaian,
                'tarif' => $tarif->tarif,
                'total' => $totalTagihan,
                'subsidi' => max(0, $subsidi),
                'status' => 'belum_bayar'
            ]
        );
    }
}
