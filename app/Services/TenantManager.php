<?php

namespace App\Services;

class TenantManager
{
    protected static $tenantId = null;

    public static function setTenantId($id)
    {
        self::$tenantId = $id;
    }

    public static function getTenantId()
    {
        return self::$tenantId;
    }

    public static function forgetTenantId()
    {
        self::$tenantId = null;
    }
}
