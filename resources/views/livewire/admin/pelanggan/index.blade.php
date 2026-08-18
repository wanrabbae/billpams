<div>
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Master Data Pelanggan</h2>
        <div class="flex space-x-2 items-center">
            <form wire:submit="import" class="flex items-center space-x-2">
                <input type="file" wire:model="importFile" class="text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" accept=".xlsx,.xls,.csv" required>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm transition" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="import">Import Excel</span>
                    <span wire:loading wire:target="import">Mengimpor...</span>
                </button>
            </form>
            <button wire:click="openModal" class="bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg text-sm transition">+ Tambah Pelanggan</button>
        </div>
    </div>
    
    @if (session()->has('message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('message') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6 flex flex-col md:flex-row gap-4 items-center">
        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama atau kode..." class="px-4 py-2 border rounded-lg w-full md:w-1/3 outline-none focus:ring-2 focus:ring-blue-500">
        
        <select wire:model.live="filterJenis" class="px-4 py-2 border rounded-lg w-full md:w-1/4 outline-none focus:ring-2 focus:ring-blue-500">
            <option value="semua">Semua Jenis</option>
            <option value="umum">Umum</option>
            <option value="sosial">Sosial</option>
            <option value="industri">Industri</option>
        </select>

        <select wire:model.live="filterStatus" class="px-4 py-2 border rounded-lg w-full md:w-1/4 outline-none focus:ring-2 focus:ring-blue-500">
            <option value="semua">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Nonaktif</option>
            <option value="dicabut">Dicabut</option>
        </select>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama & Alamat</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jenis</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 bg-white">
                    @forelse($pelanggans as $p)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $p->kode_pelanggan }}</td>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-slate-900">{{ $p->nama }}</div>
                            <div class="text-xs text-slate-500">{{ Str::limit($p->alamat, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $p->jenis_pelanggan === 'sosial' ? 'bg-orange-100 text-orange-800' : 
                                  ($p->jenis_pelanggan === 'industri' ? 'bg-indigo-100 text-indigo-800' : 'bg-blue-100 text-blue-800') }}">
                                {{ ucfirst($p->jenis_pelanggan) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $p->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('admin.pelanggan.kartu', $p->id) }}" target="_blank" class="text-emerald-600 hover:text-emerald-900 mr-3">Cetak QR</a>
                            <button wire:click="openModal({{ $p->id }})" class="text-blue-600 hover:text-blue-900 mr-3">Edit</button>
                            <button wire:click="delete({{ $p->id }})" class="text-red-600 hover:text-red-900" onclick="confirm('Yakin hapus pelanggan?') || event.stopImmediatePropagation()">Hapus</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-slate-500">Tidak ada data pelanggan ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-slate-200">
            {{ $pelanggans->links() }}
        </div>
    </div>

    <!-- Modal Form -->
    @if($isModalOpen)
    <div class="fixed inset-0 bg-slate-900 bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 max-h-screen overflow-y-auto">
            <h3 class="text-lg font-bold text-slate-800 mb-4">{{ $pelangganId ? 'Edit Pelanggan' : 'Tambah Pelanggan' }}</h3>
            
            <form wire:submit="save">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('nama') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Alamat</label>
                        <textarea wire:model="alamat" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" rows="3"></textarea>
                        @error('alamat') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Pelanggan</label>
                            <select wire:model="jenis_pelanggan" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="umum">Umum</option>
                                <option value="sosial">Sosial</option>
                                <option value="industri">Industri</option>
                            </select>
                            @error('jenis_pelanggan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                            <select wire:model="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif</option>
                                <option value="dicabut">Dicabut</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Keterangan Tambahan</label>
                        <input type="text" wire:model="keterangan" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('keterangan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                
                <div class="mt-6 flex justify-end space-x-3">
                    <button type="button" wire:click="closeModal" class="px-4 py-2 border text-slate-600 rounded-lg hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>
