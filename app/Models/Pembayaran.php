<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Tenantable;

class Pembayaran extends Model
{
    use Tenantable;

    protected $fillable = [
        'tenant_id', 'pelanggan_id', 'tagihan_id', 'nomor_kwitansi', 
        'nominal', 'uang_diterima', 'kembalian', 'metode_pembayaran',
        'tanggal', 'petugas_id', 'setoran_id', 'status'
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function setoran()
    {
        return $this->belongsTo(Setoran::class);
    }
}
