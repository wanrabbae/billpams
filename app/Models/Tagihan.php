<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Tenantable;

class Tagihan extends Model
{
    use Tenantable;

    protected $fillable = [
        'tenant_id', 'pelanggan_id', 'periode', 'meter_awal', 'meter_akhir', 
        'pemakaian', 'tarif', 'subsidi', 'total', 'status'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
