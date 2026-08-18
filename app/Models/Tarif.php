<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Tenantable;

class Tarif extends Model
{
    use Tenantable;

    protected $fillable = [
        'tenant_id', 'jenis_pelanggan', 'tarif', 'batas_gratis',
        'tarif_kelebihan', 'effective_date', 'status'
    ];
}
