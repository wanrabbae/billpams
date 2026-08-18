<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'tenant_code', 'name', 'organization_type', 'village', 'district', 
        'regency', 'province', 'address', 'logo', 'status', 'package_id'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
