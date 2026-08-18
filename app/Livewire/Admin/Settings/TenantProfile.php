<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Tenant;
use App\Services\TenantManager;
use Illuminate\Support\Facades\Storage;

class TenantProfile extends Component
{
    use WithFileUploads;

    public $tenantId;
    public $name;
    public $organization_type;
    public $village;
    public $district;
    public $regency;
    public $province;
    public $address;
    
    public $logo; // Untuk file upload baru
    public $currentLogo; // Menampilkan logo saat ini

    public function mount()
    {
        $this->tenantId = TenantManager::getTenantId();
        $tenant = Tenant::findOrFail($this->tenantId);

        $this->name = $tenant->name;
        $this->organization_type = $tenant->organization_type;
        $this->village = $tenant->village;
        $this->district = $tenant->district;
        $this->regency = $tenant->regency;
        $this->province = $tenant->province;
        $this->address = $tenant->address;
        $this->currentLogo = $tenant->logo;
    }

    public function simpanProfil()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'organization_type' => 'required|string|max:100',
            'village' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'regency' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'address' => 'nullable|string',
            'logo' => 'nullable|image|max:2048' // maks 2MB
        ]);

        $tenant = Tenant::findOrFail($this->tenantId);

        $data = [
            'name' => $this->name,
            'organization_type' => $this->organization_type,
            'village' => $this->village,
            'district' => $this->district,
            'regency' => $this->regency,
            'province' => $this->province,
            'address' => $this->address,
        ];

        if ($this->logo) {
            // Hapus logo lama jika ada
            if ($tenant->logo && Storage::disk('public')->exists($tenant->logo)) {
                Storage::disk('public')->delete($tenant->logo);
            }
            $data['logo'] = $this->logo->store('tenant_logos', 'public');
            $this->currentLogo = $data['logo'];
        }

        $tenant->update($data);

        session()->flash('success', 'Profil Organisasi (Tenant) berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.admin.settings.tenant-profile')
               ->layout('components.layouts.admin', ['header' => 'Pengaturan Profil Organisasi']);
    }
}
