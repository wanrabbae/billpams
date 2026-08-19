<?php

namespace App\Livewire\Admin\Meter;

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
    public $periode;
    public $meter_awal = 0;
    public $meter_akhir = 0;
    public $pemakaian = 0;
    public $foto_meter;

    public function mount()
    {
        $this->periode = date('Y-m'); // Default current month
    }

    public function updatedPelangganId($value)
    {
        if ($value) {
            // Coba ambil meter akhir dari bulan sebelumnya sebagai meter awal
            $lastMeter = Meter::where('pelanggan_id', $value)
                              ->orderBy('periode', 'desc')
                              ->first();
            
            $this->meter_awal = $lastMeter ? $lastMeter->meter_akhir : 0;
            $this->calculatePemakaian();
        }
    }

    public function updatedMeterAkhir()
    {
        $this->calculatePemakaian();
    }

    public function updatedMeterAwal()
    {
        $this->calculatePemakaian();
    }

    private function calculatePemakaian()
    {
        $this->pemakaian = max(0, (int)$this->meter_akhir - (int)$this->meter_awal);
    }

    public function save()
    {
        abort_if(\Auth::user()->role === 'pengawas', 403, 'Akses Read-Only');
        $this->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'periode' => 'required',
            'meter_awal' => 'required|numeric|min:0',
            'meter_akhir' => 'required|numeric|gte:meter_awal',
            'foto_meter' => 'nullable|image|max:2048',
        ], [
            'meter_akhir.gte' => 'Meter akhir tidak boleh lebih kecil dari meter awal.',
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

        // Panggil Billing Engine
        try {
            BillingEngineService::calculateBilling($meter);
            session()->flash('success', 'Catat meter berhasil disimpan dan tagihan telah digenerate.');
            $this->reset(['pelanggan_id', 'meter_awal', 'meter_akhir', 'pemakaian', 'foto_meter']);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render()
    {
        // Hanya pelanggan aktif
        $pelanggans = Pelanggan::where('status', 'aktif')->orderBy('nama')->get();

        return view('livewire.admin.meter.create', compact('pelanggans'))
               ->layout('components.layouts.admin', ['header' => 'Catat Meter Air']);
    }
}
