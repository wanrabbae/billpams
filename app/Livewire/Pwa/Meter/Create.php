<?php

namespace App\Livewire\Pwa\Meter;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Pelanggan;
use App\Models\Meter;
use App\Services\BillingEngineService;
use App\Services\TenantManager;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    use WithFileUploads;

    public $pelanggan_id;
    public $search = '';
    public $periode;
    public $meter_awal = 0;
    public $meter_akhir = '';
    public $pemakaian = 0;
    public $foto_meter;

    public function mount()
    {
        $this->periode = date('Y-m');
    }

    public function updatedPelangganId($value)
    {
        if ($value) {
            $lastMeter = Meter::where('pelanggan_id', $value)
                              ->orderBy('periode', 'desc')
                              ->first();
            
            $this->meter_awal = $lastMeter ? $lastMeter->meter_akhir : 0;
            $this->meter_akhir = '';
            $this->pemakaian = 0;
        }
    }

    public function updatedMeterAkhir()
    {
        $this->pemakaian = max(0, (int)$this->meter_akhir - (int)$this->meter_awal);
    }

    public function save()
    {
        $this->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'periode' => 'required',
            'meter_awal' => 'required|numeric|min:0',
            'meter_akhir' => 'required|numeric|gte:meter_awal',
            'foto_meter' => 'nullable|image|max:5120', // Max 5MB for mobile photos
        ]);

        $fotoPath = null;
        if ($this->foto_meter) {
            $fotoPath = $this->foto_meter->store('meters', 'public');
        }

        $meter = Meter::updateOrCreate(
            [
                'tenant_id' => TenantManager::getTenantId(),
                'pelanggan_id' => $this->pelanggan_id,
                'periode' => $this->periode,
            ],
            [
                'meter_awal' => $this->meter_awal,
                'meter_akhir' => $this->meter_akhir,
                'pemakaian' => $this->pemakaian,
                'foto_meter' => $fotoPath,
                'petugas_id' => Auth::id(),
            ]
        );

        try {
            BillingEngineService::calculateBilling($meter);
            session()->flash('success', 'Berhasil disimpan!');
            $this->reset(['pelanggan_id', 'meter_akhir', 'pemakaian', 'foto_meter', 'search']);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        $pelanggans = [];
        if (strlen($this->search) >= 2 || $this->pelanggan_id) {
            $pelanggans = Pelanggan::where('status', 'aktif')
                ->where(function($q) {
                    $q->where('nama', 'like', '%'.$this->search.'%')
                      ->orWhere('kode_pelanggan', 'like', '%'.$this->search.'%');
                })
                ->limit(10)
                ->get();
        }

        return view('livewire.pwa.meter.create', compact('pelanggans'))
               ->layout('components.layouts.pwa', ['header' => 'Catat Meter Air']);
    }
}
