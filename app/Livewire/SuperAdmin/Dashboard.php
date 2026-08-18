<?php

namespace App\Livewire\SuperAdmin;

use Livewire\Component;
use App\Models\Tenant;
use App\Models\User;
use App\Models\Pelanggan;

class Dashboard extends Component
{
    public function render()
    {
        $totalTenants = Tenant::count();
        $activeTenants = Tenant::where('status', 'aktif')->count();
        $suspendedTenants = Tenant::where('status', 'suspend')->count();
        
        $totalUsers = User::where('role', '!=', 'super_admin')->count();
        $totalPelanggan = Pelanggan::count();

        return view('livewire.superadmin.dashboard', compact(
            'totalTenants', 'activeTenants', 'suspendedTenants', 'totalUsers', 'totalPelanggan'
        ))->layout('components.layouts.superadmin', ['header' => 'Super Admin Dashboard']);
    }
}
