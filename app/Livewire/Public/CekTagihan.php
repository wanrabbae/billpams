<?php

namespace App\Livewire\Public;

use Livewire\Component;
use App\Models\Tenant;
use App\Models\Pelanggan;
use App\Models\Tagihan;
use Illuminate\Support\Facades\RateLimiter;

class CekTagihan extends Component
{
    public $tenant_id = '';
    public $kode_pelanggan = '';
    
    public $pelanggan = null;
    public $tagihanTerbaru = null;
    public $tunggakanBulan = 0;
    public $errorMessage = '';

    public function mount()
    {
        // Set default tenant to Sumber Urip if exists (for demo ease)
        $defaultTenant = Tenant::where('status', 'aktif')->first();
        if ($defaultTenant) {
            $this->tenant_id = $defaultTenant->id;
        }
    }

    public function cekTagihan()
    {
        $this->validate([
            'tenant_id' => 'required',
            'kode_pelanggan' => 'required',
        ]);

        $ip = request()->ip();
        
        // Proteksi Brute Force (5 attempts per minute)
        if (RateLimiter::tooManyAttempts('cek-tagihan:'.$ip, 5)) {
            $this->errorMessage = 'Terlalu banyak percobaan pencarian. Silakan tunggu 1 menit.';
            return;
        }
        RateLimiter::hit('cek-tagihan:'.$ip, 60);

        $this->errorMessage = '';
        $this->pelanggan = null;
        $this->tagihanTerbaru = null;
        $this->tunggakanBulan = 0;

        // Cari pelanggan lintas tenant
        $pelanggan = Pelanggan::withoutGlobalScopes()
            ->where('tenant_id', $this->tenant_id)
            ->where('kode_pelanggan', $this->kode_pelanggan)
            ->first();

        if (!$pelanggan) {
            $this->errorMessage = 'Data pelanggan tidak ditemukan. Periksa kembali pilihan Tenant dan Kode Pelanggan Anda.';
            return;
        }

        $this->pelanggan = $pelanggan;

        // Ambil tagihan bulan terakhir untuk ditampilkan di rincian
        $this->tagihanTerbaru = Tagihan::withoutGlobalScopes()
            ->where('pelanggan_id', $pelanggan->id)
            ->orderBy('periode', 'desc')
            ->first();

        // Hitung total tunggakan bulan
        $this->tunggakanBulan = Tagihan::withoutGlobalScopes()
            ->where('pelanggan_id', $pelanggan->id)
            ->where('status', 'belum_bayar')
            ->count();
    }

    public function render()
    {
        $tenants = Tenant::where('status', 'aktif')->get();
        return view('livewire.public.cek-tagihan', compact('tenants'))->layout('components.layouts.public');
    }
}
