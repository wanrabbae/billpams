<?php

namespace App\Livewire\Admin\Pelanggan;

use Illuminate\Support\Facades\Auth;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Pelanggan;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PelangganImport;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $filterJenis = 'semua';
    public $filterStatus = 'semua';
    public $search = '';
    public $importFile;

    // Form modal state
    public $isModalOpen = false;
    public $pelangganId;
    public $nama, $alamat, $jenis_pelanggan = 'umum', $keterangan, $status = 'aktif', $meter_awal = 0;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal($id = null)
    {
        $this->resetValidation();
        $this->reset(['nama', 'alamat', 'jenis_pelanggan', 'keterangan', 'status', 'pelangganId', 'meter_awal']);
        
        if ($id) {
            $pelanggan = Pelanggan::findOrFail($id);
            $this->pelangganId = $pelanggan->id;
            $this->nama = $pelanggan->nama;
            $this->alamat = $pelanggan->alamat;
            $this->jenis_pelanggan = $pelanggan->jenis_pelanggan;
            $this->keterangan = $pelanggan->keterangan;
            $this->status = $pelanggan->status;
        }

        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }

    public function save()
    {
        abort_if(\Auth::user()->role === 'pengawas', 403, 'Akses Read-Only');
        $this->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_pelanggan' => 'required|in:umum,sosial,industri',
            'status' => 'required|in:aktif,nonaktif,dicabut',
            'meter_awal' => 'nullable|numeric|min:0'
        ]);

        $tenantId = \App\Services\TenantManager::getTenantId();

        // Enforce Package Limits (Hanya jika membuat pelanggan baru)
        if (!$this->pelangganId) {
            $tenant = \App\Models\Tenant::with('package')->find($tenantId);
            if ($tenant && $tenant->package && $tenant->package->max_customers) {
                $currentCustomers = Pelanggan::count();
                if ($currentCustomers >= $tenant->package->max_customers) {
                    session()->flash('error', 'Gagal menambah pelanggan. Batas maksimal pelanggan untuk Paket ' . $tenant->package->name . ' Anda telah tercapai (' . $tenant->package->max_customers . '). Hubungi Super Admin untuk Upgrade.');
                    return;
                }
            }
        }

        $pelanggan = Pelanggan::updateOrCreate(
            ['id' => $this->pelangganId],
            [
                'nama' => $this->nama,
                'alamat' => $this->alamat,
                'jenis_pelanggan' => $this->jenis_pelanggan,
                'keterangan' => $this->keterangan,
                'status' => $this->status,
                'tenant_id' => $tenantId, // Auto injection
            ]
        );

        // Jika Pelanggan Baru dan ada Meter Awal > 0, buat initial meter
        if (!$this->pelangganId && $this->meter_awal > 0) {
            \App\Models\Meter::create([
                'tenant_id' => $tenantId,
                'pelanggan_id' => $pelanggan->id,
                'periode' => date('Y-m', strtotime('-1 month')), // Bulan lalu sbg patokan awal
                'meter_awal' => 0,
                'meter_akhir' => $this->meter_awal,
                'pemakaian' => 0,
                'petugas_id' => \Auth::id(),
            ]);
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        abort_if(\Auth::user()->role === 'pengawas', 403, 'Akses Read-Only');
        Pelanggan::find($id)?->delete();
    }

    public function import()
    {
        abort_if(\Auth::user()->role === 'pengawas', 403, 'Akses Read-Only');
        $this->validate([
            'importFile' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new PelangganImport, $this->importFile);

        $this->reset('importFile');
        session()->flash('message', 'Data pelanggan berhasil diimport.');
    }

    public function render()
    {
        $query = Pelanggan::query()
            ->when($this->filterJenis !== 'semua', function ($q) {
                return $q->where('jenis_pelanggan', $this->filterJenis);
            })
            ->when($this->filterStatus !== 'semua', function ($q) {
                return $q->where('status', $this->filterStatus);
            })
            ->when($this->search, function ($q) {
                return $q->where('nama', 'like', '%' . $this->search . '%')
                         ->orWhere('kode_pelanggan', 'like', '%' . $this->search . '%');
            });

        $pelanggans = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.pelanggan.index', compact('pelanggans'))
               ->layout('components.layouts.admin', ['header' => 'Data Pelanggan']);
    }
}
