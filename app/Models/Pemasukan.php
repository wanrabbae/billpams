<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Tenantable;

class Pemasukan extends Model
{
    use Tenantable;

    protected $fillable = [
        'tenant_id', 'tanggal', 'kategori', 'sumber', 
        'nominal', 'bukti', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
