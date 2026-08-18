<div>
    @if (session()->has('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    @if($showForm)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl mb-6">
            <h2 class="text-xl font-bold text-slate-800 mb-6">{{ $packageId ? 'Edit Paket' : 'Buat Paket Baru' }}</h2>
            <form wire:submit.prevent="simpanPackage">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Paket</label>
                        <input type="text" wire:model="name" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Cth: BASIC / STANDARD / ENTERPRISE">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Batas Maksimal Pelanggan</label>
                        <input type="number" wire:model="max_customers" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Biarkan kosong (kredit) untuk Unlimited">
                        <p class="text-xs text-slate-500 mt-1">Kosongkan jika tidak ada batasan pelanggan (Unlimited).</p>
                        @error('max_customers') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Harga Langganan (Rp / Bulan)</label>
                        <input type="number" wire:model="price" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Cth: 150000">
                        @error('price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 flex space-x-3">
                    <button type="button" wire:click="closeForm" class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" wire:loading.attr="disabled">Simpan Paket</button>
                </div>
            </form>
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-bold text-slate-800">Daftar Harga Paket SaaS</h2>
        <button wire:click="openForm" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition shadow-sm text-sm">
            + Tambah Paket
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach($packages as $pkg)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col">
            <div class="p-6 border-b border-slate-100 flex-1">
                <h3 class="text-lg font-bold text-blue-700 uppercase mb-2">{{ $pkg->name }}</h3>
                <div class="text-2xl font-bold text-slate-800 mb-1">Rp {{ number_format($pkg->price, 0, ',', '.') }}</div>
                <div class="text-sm text-slate-500 mb-6">per bulan / tenant</div>
                
                <ul class="space-y-3 mb-6">
                    <li class="flex items-center text-sm text-slate-700">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Maksimal {{ $pkg->max_customers ? number_format($pkg->max_customers, 0, ',', '.') : 'Tidak Terbatas' }} Pelanggan
                    </li>
                    <li class="flex items-center text-sm text-slate-700">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Manajemen Tagihan & Kasir
                    </li>
                    <li class="flex items-center text-sm text-slate-700">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Akses PWA Mobile
                    </li>
                </ul>
            </div>
            <div class="bg-slate-50 p-4 border-t border-slate-100 flex justify-between items-center">
                <div class="text-xs text-slate-500 font-medium">
                    Digunakan oleh: <span class="font-bold text-slate-800">{{ $pkg->tenants_count }} Tenant</span>
                </div>
                <button wire:click="openForm({{ $pkg->id }})" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</button>
            </div>
        </div>
        @endforeach
    </div>
</div>
