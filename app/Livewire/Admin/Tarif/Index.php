<?php

namespace App\Livewire\Admin\Tarif;

use Livewire\Component;
use App\Models\Tarif;
use App\Services\TenantManager;

class Index extends Component
{
    public $tarifs;

    // Form fields
    public $tarifId = null;
    public $jenis_pelanggan = 'umum';
    public $tarif = '';
    public $batas_gratis = 0;
    public $tarif_kelebihan = 0;
    public $effective_date = '';
    public $status = 'aktif';

    public $showForm = false;

    public function mount()
    {
        $this->effective_date = date('Y-m-d');
        $this->loadData();
    }

    public function loadData()
    {
        $this->tarifs = Tarif::where('tenant_id', TenantManager::getTenantId())
            ->orderBy('jenis_pelanggan')
            ->orderBy('effective_date', 'desc')
            ->get();
    }

    public function create()
    {
        $this->resetFields();
        $this->showForm = true;
    }

    public function edit($id)
    {
        $data = Tarif::findOrFail($id);
        $this->tarifId = $data->id;
        $this->jenis_pelanggan = $data->jenis_pelanggan;
        $this->tarif = (int) $data->tarif;
        $this->batas_gratis = $data->batas_gratis;
        $this->tarif_kelebihan = (int) $data->tarif_kelebihan;
        $this->effective_date = $data->effective_date;
        $this->status = $data->status;
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate([
            'jenis_pelanggan' => 'required|in:umum,sosial,industri',
            'tarif' => 'required|numeric|min:0',
            'batas_gratis' => 'required|numeric|min:0',
            'tarif_kelebihan' => 'required|numeric|min:0',
            'effective_date' => 'required|date',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        if ($this->tarifId) {
            $data = Tarif::findOrFail($this->tarifId);
            $data->update([
                'jenis_pelanggan' => $this->jenis_pelanggan,
                'tarif' => $this->tarif,
                'batas_gratis' => $this->batas_gratis,
                'tarif_kelebihan' => $this->tarif_kelebihan,
                'effective_date' => $this->effective_date,
                'status' => $this->status,
            ]);
            session()->flash('success', 'Tarif berhasil diperbarui.');
        } else {
            // Jika ada tarif aktif dengan jenis_pelanggan sama, nonaktifkan dulu yang lama?
            // (Opsional) Tergantung business rules. Kita simpan sesuai form saja.
            
            Tarif::create([
                'tenant_id' => TenantManager::getTenantId(),
                'jenis_pelanggan' => $this->jenis_pelanggan,
                'tarif' => $this->tarif,
                'batas_gratis' => $this->batas_gratis,
                'tarif_kelebihan' => $this->tarif_kelebihan,
                'effective_date' => $this->effective_date,
                'status' => $this->status,
            ]);
            session()->flash('success', 'Tarif baru berhasil ditambahkan.');
        }

        $this->resetFields();
        $this->showForm = false;
        $this->loadData();
    }

    public function cancel()
    {
        $this->resetFields();
        $this->showForm = false;
    }

    public function resetFields()
    {
        $this->tarifId = null;
        $this->jenis_pelanggan = 'umum';
        $this->tarif = '';
        $this->batas_gratis = 0;
        $this->tarif_kelebihan = 0;
        $this->effective_date = date('Y-m-d');
        $this->status = 'aktif';
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.tarif.index')
            ->layout('components.layouts.admin', ['header' => 'Manajemen Tarif Air']);
    }
}
