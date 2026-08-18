<?php

namespace App\Livewire\SuperAdmin\Package;

use Livewire\Component;
use App\Models\Package;
use App\Models\Tenant;

class Index extends Component
{
    public $showForm = false;
    public $packageId;
    public $name, $max_customers, $price, $description;

    public function openForm($id = null)
    {
        $this->resetValidation();
        $this->reset(['name', 'max_customers', 'price', 'description', 'packageId']);
        
        if ($id) {
            $pkg = Package::findOrFail($id);
            $this->packageId = $pkg->id;
            $this->name = $pkg->name;
            $this->max_customers = $pkg->max_customers;
            $this->price = $pkg->price;
            $this->description = $pkg->description;
        }

        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function simpanPackage()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'max_customers' => 'nullable|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Package::updateOrCreate(
            ['id' => $this->packageId],
            [
                'name' => $this->name,
                'max_customers' => $this->max_customers === '' ? null : $this->max_customers,
                'price' => $this->price,
                'description' => $this->description,
            ]
        );

        session()->flash('success', 'Paket berlangganan berhasil disimpan.');
        $this->closeForm();
    }

    public function render()
    {
        $packages = Package::withCount('tenants')->get();

        return view('livewire.superadmin.package.index', compact('packages'))
               ->layout('components.layouts.superadmin', ['header' => 'Manajemen Paket SaaS']);
    }
}
