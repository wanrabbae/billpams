<?php
// Function to replace strings in files
function patchFile($filePath, $search, $replace) {
    if (file_exists($filePath)) {
        $content = file_get_contents($filePath);
        $content = str_replace($search, $replace, $content);
        file_put_contents($filePath, $content);
        echo "Patched $filePath\n";
    }
}

// 1. Pelanggan Index
$pelanggan = 'resources/views/livewire/admin/pelanggan/index.blade.php';
patchFile($pelanggan, 
    '<form wire:submit="import" class="flex items-center space-x-2">', 
    '@if(Auth::user()->role !== "pengawas")<form wire:submit="import" class="flex items-center space-x-2">'
);
patchFile($pelanggan, 
    '<button wire:click="openModal" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition">+ Tambah Pelanggan</button>', 
    '</form><button wire:click="openModal" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition">+ Tambah Pelanggan</button>@endif'
);
patchFile($pelanggan, 
    '<button wire:click="openModal({{ $p->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $p->id }})" class="text-red-600 hover:text-red-900" onclick="confirm(\'Yakin hapus pelanggan?\') || event.stopImmediatePropagation()">Hapus</button>', 
    '@if(Auth::user()->role !== "pengawas")<button wire:click="openModal({{ $p->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $p->id }})" class="text-red-600 hover:text-red-900" onclick="confirm(\'Yakin hapus pelanggan?\') || event.stopImmediatePropagation()">Hapus</button>@endif'
);

// 2. Tarif Index
$tarif = 'resources/views/livewire/admin/tarif/index.blade.php';
patchFile($tarif, 
    '<button wire:click="openModal" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition">+ Tambah Tarif</button>', 
    '@if(Auth::user()->role !== "pengawas")<button wire:click="openModal" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition">+ Tambah Tarif</button>@endif'
);
patchFile($tarif, 
    '<button wire:click="openModal({{ $t->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $t->id }})" class="text-red-600 hover:text-red-900" onclick="confirm(\'Yakin hapus tarif ini?\') || event.stopImmediatePropagation()">Hapus</button>', 
    '@if(Auth::user()->role !== "pengawas")<button wire:click="openModal({{ $t->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $t->id }})" class="text-red-600 hover:text-red-900" onclick="confirm(\'Yakin hapus tarif ini?\') || event.stopImmediatePropagation()">Hapus</button>@endif'
);

// 3. Meter Create
$meter = 'resources/views/livewire/admin/meter/create.blade.php';
patchFile($meter, 
    '<form wire:submit="save">', 
    '<form wire:submit="save">
        @if(Auth::user()->role === "pengawas")
            <div class="mb-4 bg-orange-100 text-orange-700 p-3 rounded text-sm font-medium border border-orange-200">ℹ️ Anda masuk sebagai Pengawas (Read-Only). Anda tidak dapat menyimpan data meter.</div>
        @endif'
);
patchFile($meter, 
    '<button type="submit" class="w-full bg-blue-700 text-white py-3 rounded-lg font-bold hover:bg-blue-800 transition">Simpan Catat Meter & Generate Tagihan</button>', 
    '@if(Auth::user()->role !== "pengawas")<button type="submit" class="w-full bg-blue-700 text-white py-3 rounded-lg font-bold hover:bg-blue-800 transition">Simpan Catat Meter & Generate Tagihan</button>@endif'
);

// 4. Penagihan Index
$penagihan = 'resources/views/livewire/admin/penagihan/index.blade.php';
patchFile($penagihan, 
    '<button wire:click="generateTagihanBulanIni" wire:loading.attr="disabled" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition font-medium flex items-center">', 
    '@if(Auth::user()->role !== "pengawas")<button wire:click="generateTagihanBulanIni" wire:loading.attr="disabled" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition font-medium flex items-center">'
);
patchFile($penagihan, 
    'Generate Tagihan Bulan Ini
        </button>', 
    'Generate Tagihan Bulan Ini
        </button>@endif'
);

// 5. Penagihan Eksekusi
$eksekusi = 'resources/views/livewire/admin/penagihan/eksekusi.blade.php';
patchFile($eksekusi, 
    '<form wire:submit="executeAction">', 
    '<form wire:submit="executeAction">
            @if(Auth::user()->role === "pengawas")
                <div class="mb-4 bg-orange-100 text-orange-700 p-3 rounded text-sm font-medium border border-orange-200">ℹ️ Anda masuk sebagai Pengawas (Read-Only). Anda tidak dapat melakukan eksekusi.</div>
            @endif'
);
patchFile($eksekusi, 
    '<button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded-lg hover:bg-blue-800 font-medium transition">Eksekusi Tindakan</button>', 
    '@if(Auth::user()->role !== "pengawas")<button type="submit" class="bg-blue-700 text-white px-6 py-2 rounded-lg hover:bg-blue-800 font-medium transition">Eksekusi Tindakan</button>@endif'
);

// 6. Setoran Index
$setoran = 'resources/views/livewire/admin/keuangan/setoran/index.blade.php';
patchFile($setoran, 
    '<button wire:click="terimaSetoran({{ $s->id }})" class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1.5 rounded mr-2 transition">Terima</button>
                                <button wire:click="tolakSetoran({{ $s->id }})" class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1.5 rounded transition">Tolak</button>', 
    '@if(Auth::user()->role !== "pengawas")<button wire:click="terimaSetoran({{ $s->id }})" class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1.5 rounded mr-2 transition">Terima</button>
                                <button wire:click="tolakSetoran({{ $s->id }})" class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1.5 rounded transition">Tolak</button>@endif'
);

// 7. Kas Index
$kas = 'resources/views/livewire/admin/keuangan/kas/index.blade.php';
patchFile($kas, 
    '<div class="flex space-x-2">
            <a href="{{ route(\'admin.keuangan.kas.export.excel\', [\'bulan\' => $bulan, \'tahun\' => $tahun]) }}" target="_blank" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm transition font-medium flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Excel
            </a>
            <a href="{{ route(\'admin.keuangan.kas.export.pdf\', [\'bulan\' => $bulan, \'tahun\' => $tahun]) }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition font-medium flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                PDF
            </a>
            <button wire:click="openModal" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition font-medium">+ Transaksi Baru</button>
        </div>', 
    '<div class="flex space-x-2">
            <a href="{{ route(\'admin.keuangan.kas.export.excel\', [\'bulan\' => $bulan, \'tahun\' => $tahun]) }}" target="_blank" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm transition font-medium flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Excel
            </a>
            <a href="{{ route(\'admin.keuangan.kas.export.pdf\', [\'bulan\' => $bulan, \'tahun\' => $tahun]) }}" target="_blank" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition font-medium flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                PDF
            </a>
            @if(Auth::user()->role !== "pengawas")
            <button wire:click="openModal" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition font-medium">+ Transaksi Baru</button>
            @endif
        </div>'
);
patchFile($kas, 
    '<button wire:click="voidTransaksi({{ $k->id }})" onclick="confirm(\'Yakin membatalkan transaksi ini? Saldo akan disesuaikan kembali.\') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 text-xs font-medium">VOID</button>', 
    '@if(Auth::user()->role !== "pengawas")<button wire:click="voidTransaksi({{ $k->id }})" onclick="confirm(\'Yakin membatalkan transaksi ini? Saldo akan disesuaikan kembali.\') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-900 text-xs font-medium">VOID</button>@endif'
);

