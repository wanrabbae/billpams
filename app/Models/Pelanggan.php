<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Tenantable;

class Pelanggan extends Model
{
    use Tenantable;

    protected $fillable = ['tenant_id', 'kode_pelanggan', 'nama', 'alamat', 'status', 'jenis_pelanggan', 'keterangan'];

    protected static function booted()
    {
        static::creating(function ($pelanggan) {
            if (empty($pelanggan->kode_pelanggan)) {
                $prefix = match ($pelanggan->jenis_pelanggan) {
                    'umum' => 'UM',
                    'sosial' => 'SO',
                    'industri' => 'IN',
                    default => 'UM',
                };
                
                $year = date('Y');
                $tenantId = \App\Services\TenantManager::getTenantId() ?? $pelanggan->tenant_id;
                
                // Get latest count for this type and year
                $latest = static::withoutGlobalScopes()
                    ->where('tenant_id', $tenantId)
                    ->where('kode_pelanggan', 'like', "{$prefix}-{$year}-%")
                    ->orderBy('id', 'desc')
                    ->first();
                
                $sequence = 1;
                if ($latest) {
                    $parts = explode('-', $latest->kode_pelanggan);
                    $sequence = intval(end($parts)) + 1;
                }
                
                $pelanggan->kode_pelanggan = sprintf("%s-%s-%03d", $prefix, $year, $sequence);
            }
        });
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class);
    }
}
