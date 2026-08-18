<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Tenant;
use App\Services\TenantManager;

class CardController extends Controller
{
    public function cetak($id)
    {
        $tenantId = TenantManager::getTenantId();
        
        $pelanggan = Pelanggan::where('tenant_id', $tenantId)->findOrFail($id);
        $tenant = Tenant::findOrFail($tenantId);

        return view('admin.pelanggan.kartu', compact('pelanggan', 'tenant'));
    }
}
