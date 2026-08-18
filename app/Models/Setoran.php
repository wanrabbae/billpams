<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Tenantable;

class Setoran extends Model
{
    use Tenantable;

    protected $fillable = [
        'tenant_id', 'petugas_id', 'tanggal', 'jumlah_transaksi',
        'total_penerimaan', 'total_setoran', 'selisih', 'status'
    ];

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }

    public function pembayarans()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
