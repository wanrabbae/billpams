<?php

namespace App\Livewire\Admin\Keuangan\Kas;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Pemasukan;
use App\Models\Pengeluaran;
use App\Services\TenantManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Index extends Component
{
    use WithPagination, WithFileUploads;

    public $bulan;
    public $tahun;

    // Form fields
    public $showForm = false;
    public $formType = 'pengeluaran'; // 'pemasukan' or 'pengeluaran'
    public $tanggal;
    public $kategori;
    public $deskripsi; // digunakan untuk 'sumber' di pemasukan atau 'keterangan' di pengeluaran
    public $nominal;
    public $bukti;

    public function mount()
    {
        $this->bulan = date('m');
        $this->tahun = date('Y');
        $this->tanggal = date('Y-m-d');
    }

    public function updatingBulan()
    {
        $this->resetPage();
    }

    public function updatingTahun()
    {
        $this->resetPage();
    }

    public function openForm($type)
    {
        $this->resetValidation();
        $this->formType = $type;
        $this->tanggal = date('Y-m-d');
        $this->kategori = '';
        $this->deskripsi = '';
        $this->nominal = '';
        $this->bukti = null;
        $this->showForm = true;
    }

    public function closeForm()
    {
        $this->showForm = false;
    }

    public function simpanTransaksi()
    {
        $this->validate([
            'tanggal' => 'required|date',
            'kategori' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:255',
            'nominal' => 'required|numeric|min:1',
            'bukti' => 'nullable|image|max:2048'
        ]);

        $buktiPath = null;
        if ($this->bukti) {
            $buktiPath = $this->bukti->store('bukti_kas', 'public');
        }

        if ($this->formType === 'pemasukan') {
            Pemasukan::create([
                'tenant_id' => TenantManager::getTenantId(),
                'tanggal' => $this->tanggal,
                'kategori' => $this->kategori,
                'sumber' => $this->deskripsi,
                'nominal' => $this->nominal,
                'bukti' => $buktiPath,
                'user_id' => Auth::id()
            ]);
            session()->flash('success', 'Data Pemasukan berhasil disimpan.');
        } else {
            Pengeluaran::create([
                'tenant_id' => TenantManager::getTenantId(),
                'tanggal' => $this->tanggal,
                'kategori' => $this->kategori,
                'keterangan' => $this->deskripsi,
                'nominal' => $this->nominal,
                'bukti' => $buktiPath,
                'user_id' => Auth::id()
            ]);
            session()->flash('success', 'Data Pengeluaran berhasil disimpan.');
        }

        $this->closeForm();
    }

    public function getBukuKasProperty()
    {
        $tenantId = TenantManager::getTenantId();
        
        $pemasukan = Pemasukan::where('tenant_id', $tenantId)
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'M-'.$item->id,
                    'tanggal' => $item->tanggal,
                    'tipe' => 'Masuk',
                    'kategori' => $item->kategori,
                    'deskripsi' => $item->sumber,
                    'debit' => $item->nominal,
                    'kredit' => 0,
                    'created_at' => $item->created_at,
                    'petugas' => $item->user->name ?? '-'
                ];
            });

        $pengeluaran = Pengeluaran::where('tenant_id', $tenantId)
            ->whereMonth('tanggal', $this->bulan)
            ->whereYear('tanggal', $this->tahun)
            ->get()
            ->map(function ($item) {
                return [
                    'id' => 'K-'.$item->id,
                    'tanggal' => $item->tanggal,
                    'tipe' => 'Keluar',
                    'kategori' => $item->kategori,
                    'deskripsi' => $item->keterangan,
                    'debit' => 0,
                    'kredit' => $item->nominal,
                    'created_at' => $item->created_at,
                    'petugas' => $item->user->name ?? '-'
                ];
            });

        // Gabungkan dan urutkan berdasarkan tanggal lalu created_at
        $bukuKas = $pemasukan->concat($pengeluaran)->sortBy([
            ['tanggal', 'asc'],
            ['created_at', 'asc']
        ])->values();

        // Hitung Saldo Awal (sebelum bulan dan tahun yang dipilih)
        $saldoAwalPemasukan = Pemasukan::where('tenant_id', $tenantId)
            ->where(function($q) {
                $q->whereYear('tanggal', '<', $this->tahun)
                  ->orWhere(function($sq) {
                      $sq->whereYear('tanggal', $this->tahun)
                         ->whereMonth('tanggal', '<', $this->bulan);
                  });
            })->sum('nominal');

        $saldoAwalPengeluaran = Pengeluaran::where('tenant_id', $tenantId)
            ->where(function($q) {
                $q->whereYear('tanggal', '<', $this->tahun)
                  ->orWhere(function($sq) {
                      $sq->whereYear('tanggal', $this->tahun)
                         ->whereMonth('tanggal', '<', $this->bulan);
                  });
            })->sum('nominal');

        $saldoAwal = $saldoAwalPemasukan - $saldoAwalPengeluaran;

        // Kalkulasi running balance (Saldo Berjalan)
        $runningBalance = $saldoAwal;
        $bukuKas = $bukuKas->map(function ($item) use (&$runningBalance) {
            $runningBalance += $item['debit'] - $item['kredit'];
            $item['saldo'] = $runningBalance;
            return $item;
        });

        return [
            'saldoAwal' => $saldoAwal,
            'transaksi' => $bukuKas,
            'totalMasuk' => $pemasukan->sum('debit'),
            'totalKeluar' => $pengeluaran->sum('kredit'),
            'saldoAkhir' => $runningBalance
        ];
    }

    public function render()
    {
        return view('livewire.admin.keuangan.kas.index', [
            'kas' => $this->bukuKas
        ])->layout('components.layouts.admin', ['header' => 'Buku Kas Umum']);
    }
}
