<?php

namespace App\Livewire\SuperAdmin\Tenant;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $showForm = false;

    // Tenant Form
    public $name;
    public $organization_type = 'HIPPAM';
    public $status = 'aktif';
    public $package_id;
    public $logo;
    
    // Admin Tenant Form
    public $admin_name;
    public $admin_username;
    public $admin_password;

    public $packages = [];

    public function mount()
    {
        $this->packages = \App\Models\Package::all();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openForm()
    {
        $this->resetValidation();
        $this->reset(['name', 'organization_type', 'status', 'package_id', 'logo', 'admin_name', 'admin_username', 'admin_password']);
        
        // Auto select Basic package if available
        if ($this->packages->count() > 0) {
            $this->package_id = $this->packages->first()->id;
        }

        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function simpanTenant()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'organization_type' => 'required|string',
            'status' => 'required|in:aktif,nonaktif,suspend',
            'package_id' => 'required|exists:packages,id',
            'logo' => 'nullable|image|max:2048',
            'admin_name' => 'required|string|max:255',
            'admin_username' => 'required|string|max:50|unique:users,username',
            'admin_password' => 'required|min:6',
        ]);

        DB::beginTransaction();
        try {
            $logoPath = null;
            if ($this->logo) {
                $logoPath = $this->logo->store('tenant_logos', 'public');
            }

            // 1. Create Tenant
            $tenantCode = strtoupper(Str::random(8));
            $tenant = Tenant::create([
                'tenant_code' => $tenantCode,
                'name' => $this->name,
                'organization_type' => $this->organization_type,
                'status' => $this->status,
                'package_id' => $this->package_id,
                'logo' => $logoPath,
            ]);

            // 2. Create Admin Tenant User
            User::create([
                'tenant_id' => $tenant->id,
                'name' => $this->admin_name,
                'username' => $this->admin_username,
                'role' => 'admin_tenant',
                'status' => 'aktif',
                'password' => Hash::make($this->admin_password),
            ]);

            DB::commit();
            session()->flash('success', 'Tenant HIPPAM baru beserta akun Admin berhasil dibuat!');
            $this->closeForm();
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function toggleStatus($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->update([
            'status' => $tenant->status === 'aktif' ? 'suspend' : 'aktif'
        ]);
        session()->flash('success', 'Status Tenant berhasil diubah.');
    }

    public function render()
    {
        $tenants = Tenant::when(strlen($this->search) >= 2, function($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                  ->orWhere('tenant_code', 'like', '%'.$this->search.'%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('livewire.superadmin.tenant.index', compact('tenants'))
               ->layout('components.layouts.superadmin', ['header' => 'Manajemen HIPPAM (Tenant)']);
    }
}
