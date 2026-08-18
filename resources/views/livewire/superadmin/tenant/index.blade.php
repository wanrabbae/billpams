<div>
    @if (session()->has('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            {{ session('error') }}
        </div>
    @endif

    @if($showForm)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-4xl mb-6">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Registrasi Organisasi / Tenant Baru</h2>
            <form wire:submit.prevent="simpanTenant">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Kiri: Data Tenant -->
                    <div>
                        <h3 class="text-md font-bold text-slate-700 mb-4 border-b pb-2">Informasi HIPPAM / Organisasi</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Organisasi</label>
                                <input type="text" wire:model="name" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Cth: HIPPAMS TIRTA MAKMUR">
                                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Tipe Organisasi</label>
                                <select wire:model="organization_type" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                    <option value="HIPPAM">HIPPAM</option>
                                    <option value="PAMSIMAS">PAMSIMAS</option>
                                    <option value="BUMDES">BUMDes</option>
                                </select>
                                @error('organization_type') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Paket SaaS</label>
                                <select wire:model="package_id" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                    <option value="">-- Pilih Paket Berlangganan --</option>
                                    @foreach($packages as $pkg)
                                        <option value="{{ $pkg->id }}">{{ $pkg->name }} (Maks. {{ $pkg->max_customers ? number_format($pkg->max_customers, 0, ',', '.') : 'Unlimited' }} Pelanggan) - Rp {{ number_format($pkg->price, 0, ',', '.') }} /bln</option>
                                    @endforeach
                                </select>
                                @error('package_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Logo HIPPAM (Opsional)</label>
                                <div class="flex items-center space-x-4">
                                    @if ($logo)
                                        <img src="{{ $logo->temporaryUrl() }}" class="h-12 w-12 object-contain rounded-lg border border-slate-200">
                                    @else
                                        <div class="h-12 w-12 rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 text-xs">Logo</div>
                                    @endif
                                    <div class="flex-1">
                                        <input type="file" wire:model="logo" accept="image/png, image/jpeg" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border rounded-lg">
                                    </div>
                                </div>
                                <div wire:loading wire:target="logo" class="text-xs text-blue-500 mt-1">Mengunggah...</div>
                                @error('logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Status Awal</label>
                                <select wire:model="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                    <option value="aktif">Aktif (Live)</option>
                                    <option value="nonaktif">Nonaktif</option>
                                </select>
                                @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Kanan: Data Admin -->
                    <div>
                        <h3 class="text-md font-bold text-slate-700 mb-4 border-b pb-2">Akun Pengurus (Admin Tenant) Pertama</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Admin</label>
                                <input type="text" wire:model="admin_name" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Cth: Budi Santoso">
                                @error('admin_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Username Login</label>
                                <input type="text" wire:model="admin_username" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Cth: admin_tirta">
                                @error('admin_username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                                <input type="password" wire:model="admin_password" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Minimal 6 karakter">
                                @error('admin_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <p class="text-xs text-slate-500 mt-2 bg-blue-50 p-3 rounded border border-blue-100">
                                Info: Akun ini akan otomatis memiliki role `admin_tenant` dan bisa menambahkan petugas lainnya setelah login.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-4 border-t border-slate-200 flex justify-end space-x-3">
                    <button type="button" wire:click="closeForm" class="px-5 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition font-medium">Batal</button>
                    <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-medium" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="simpanTenant">Daftarkan Tenant & Admin</span>
                        <span wire:loading wire:target="simpanTenant">Memproses...</span>
                    </button>
                </div>
            </form>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-200 bg-slate-50 flex flex-wrap justify-between items-center gap-4">
            <div class="relative max-w-sm w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Cari nama HIPPAM atau Kode...">
            </div>
            
            <button wire:click="openForm" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition shadow-sm text-sm flex items-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Registrasi Tenant Baru
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b">
                    <tr>
                        <th class="px-6 py-4">Kode Tenant</th>
                        <th class="px-6 py-4">Organisasi</th>
                        <th class="px-6 py-4">Tanggal Daftar</th>
                        <th class="px-6 py-4 text-center">Status Akses</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($tenants as $tenant)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-mono text-sm font-bold text-blue-700">
                                {{ $tenant->tenant_code }}
                            </td>
                            <td class="px-6 py-4 flex items-center space-x-3">
                                @if($tenant->logo)
                                    <img src="{{ Storage::url($tenant->logo) }}" class="h-10 w-10 object-contain rounded-full border border-slate-200 bg-white">
                                @else
                                    <div class="h-10 w-10 rounded-full bg-slate-200 border border-slate-300 flex items-center justify-center text-slate-400 text-xs font-bold">
                                        {{ substr($tenant->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <div class="font-bold text-slate-800 uppercase">{{ $tenant->name }}</div>
                                    <div class="text-xs text-slate-500">{{ $tenant->organization_type }}</div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-slate-600">
                                {{ \Carbon\Carbon::parse($tenant->created_at)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($tenant->status === 'aktif')
                                    <span class="inline-flex items-center text-green-700 bg-green-100 px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                        <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div> Aktif
                                    </span>
                                @elseif($tenant->status === 'suspend')
                                    <span class="inline-flex items-center text-red-700 bg-red-100 px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                        <div class="w-2 h-2 rounded-full bg-red-500 mr-2"></div> Suspend
                                    </span>
                                @else
                                    <span class="inline-flex items-center text-slate-700 bg-slate-200 px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">
                                        {{ $tenant->status }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                @if($tenant->status === 'aktif')
                                    <button wire:click="toggleStatus({{ $tenant->id }})" wire:confirm="Yakin ingin mensuspend organisasi ini? Semua petugas mereka tidak akan bisa login." class="text-red-600 hover:text-red-800 font-medium text-xs border border-red-200 bg-red-50 px-2 py-1 rounded">Suspend (Blokir)</button>
                                @else
                                    <button wire:click="toggleStatus({{ $tenant->id }})" class="text-green-600 hover:text-green-800 font-medium text-xs border border-green-200 bg-green-50 px-2 py-1 rounded">Buka Akses</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                Belum ada Tenant / Organisasi yang terdaftar.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($tenants->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $tenants->links() }}
        </div>
        @endif
    </div>
</div>
