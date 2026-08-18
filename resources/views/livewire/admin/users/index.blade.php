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
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl mb-6">
            <h2 class="text-xl font-bold text-slate-800 mb-6">{{ $userId ? 'Edit Akun' : 'Tambah Akun Baru' }}</h2>
            <form wire:submit.prevent="simpanUser">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="name" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Cth: Budi Santoso">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Username Login</label>
                        <input type="text" wire:model="username" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Cth: budi123">
                        @error('username') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Role / Peran</label>
                            <select wire:model="role" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="petugas">Petugas Lapangan (Kasir/Meter)</option>
                                <option value="bendahara">Bendahara (Keuangan)</option>
                                <option value="pengawas">Pengawas (Read Only)</option>
                                <option value="admin_tenant">Admin (Akses Penuh)</option>
                            </select>
                            @error('role') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                            <select wire:model="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                                <option value="aktif">Aktif</option>
                                <option value="nonaktif">Nonaktif (Suspend)</option>
                            </select>
                            @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <input type="password" wire:model="password" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="{{ $userId ? 'Biarkan kosong jika tidak ingin mengubah password' : 'Minimal 6 karakter' }}">
                        @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="mt-6 flex space-x-3">
                    <button type="button" wire:click="closeForm" class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" wire:loading.attr="disabled">Simpan Data</button>
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
                <input wire:model.live.debounce.300ms="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500" placeholder="Cari nama atau username...">
            </div>
            
            <button wire:click="openForm" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition shadow-sm text-sm">
                + Tambah Akun
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b">
                    <tr>
                        <th class="px-6 py-4">Nama User</th>
                        <th class="px-6 py-4">Username</th>
                        <th class="px-6 py-4 text-center">Peran (Role)</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Terakhir Login</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 font-bold text-slate-800">
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-600 font-mono text-xs">
                                {{ $user->username }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($user->role === 'admin_tenant')
                                    <span class="inline-flex bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Admin</span>
                                @elseif($user->role === 'bendahara')
                                    <span class="inline-flex bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Bendahara</span>
                                @elseif($user->role === 'pengawas')
                                    <span class="inline-flex bg-orange-100 text-orange-800 px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Pengawas</span>
                                @else
                                    <span class="inline-flex bg-slate-100 text-slate-800 px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Petugas</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($user->status === 'aktif')
                                    <span class="inline-flex items-center text-green-600 text-xs font-bold">
                                        <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div> Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center text-red-600 text-xs font-bold">
                                        <div class="w-2 h-2 rounded-full bg-red-500 mr-2"></div> Suspend
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center text-slate-500 text-xs">
                                {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->diffForHumans() : 'Belum pernah' }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <button wire:click="openForm({{ $user->id }})" class="text-blue-600 hover:text-blue-800 font-medium text-xs">Edit</button>
                                
                                @if(Auth::id() !== $user->id && $user->role !== 'admin_tenant')
                                    @if($user->status === 'aktif')
                                        <button wire:click="toggleStatus({{ $user->id }})" class="text-red-600 hover:text-red-800 font-medium text-xs">Suspend</button>
                                    @else
                                        <button wire:click="toggleStatus({{ $user->id }})" class="text-green-600 hover:text-green-800 font-medium text-xs">Aktifkan</button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                Tidak ada data akun.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($users->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $users->links() }}
        </div>
        @endif
    </div>
</div>
