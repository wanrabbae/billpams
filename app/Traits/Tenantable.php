<?php

namespace App\Traits;

use App\Models\Scopes\TenantScope;
use App\Services\TenantManager;
use App\Models\Tenant;

trait Tenantable
{
    protected static function bootTenantable()
    {
        static::addGlobalScope(new TenantScope);

        static::creating(function ($model) {
            if (!$model->tenant_id && TenantManager::getTenantId()) {
                $model->tenant_id = TenantManager::getTenantId();
            }
        });
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
