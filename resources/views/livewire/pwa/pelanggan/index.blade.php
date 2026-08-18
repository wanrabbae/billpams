<div>
    <!-- Sticky Header Area -->
    <div class="bg-blue-700 text-white pb-6 pt-2 px-4 rounded-b-3xl -mx-4 -mt-4 shadow-md sticky top-0 z-10">
        <!-- Search Bar -->
        <div class="relative mb-4">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
            </div>
            <input type="text" wire:model.live.debounce.300ms="search" class="w-full bg-white text-slate-900 text-sm rounded-full pl-10 py-3 shadow-inner outline-none focus:ring-2 focus:ring-blue-300" placeholder="Cari kode / nama / alamat...">
        </div>

        <!-- Horizontal Filter Pills -->
        <div class="flex space-x-2 overflow-x-auto pb-1 scrollbar-hide">
            <button wire:click="$set('filterJenis', 'semua')" class="whitespace-nowrap px-4 py-1.5 rounded-full text-sm font-medium transition {{ $filterJenis === 'semua' ? 'bg-white text-blue-700 shadow-sm' : 'bg-blue-800 text-blue-100 hover:bg-blue-600' }}">Semua</button>
            <button wire:click="$set('filterJenis', 'umum')" class="whitespace-nowrap px-4 py-1.5 rounded-full text-sm font-medium transition {{ $filterJenis === 'umum' ? 'bg-white text-blue-700 shadow-sm' : 'bg-blue-800 text-blue-100 hover:bg-blue-600' }}">Umum</button>
            <button wire:click="$set('filterJenis', 'sosial')" class="whitespace-nowrap px-4 py-1.5 rounded-full text-sm font-medium transition {{ $filterJenis === 'sosial' ? 'bg-white text-blue-700 shadow-sm' : 'bg-blue-800 text-blue-100 hover:bg-blue-600' }}">Sosial</button>
            <button wire:click="$set('filterJenis', 'industri')" class="whitespace-nowrap px-4 py-1.5 rounded-full text-sm font-medium transition {{ $filterJenis === 'industri' ? 'bg-white text-blue-700 shadow-sm' : 'bg-blue-800 text-blue-100 hover:bg-blue-600' }}">Industri</button>
        </div>
    </div>

    <!-- List View -->
    <div class="mt-6 space-y-3">
        @forelse($pelanggans as $p)
        <div class="bg-white rounded-xl p-4 shadow-sm border border-slate-100 flex justify-between items-center relative overflow-hidden">
            <!-- Left border color indicator -->
            <div class="absolute left-0 top-0 bottom-0 w-1 {{ $p->status === 'aktif' ? 'bg-green-500' : 'bg-red-500' }}"></div>
            
            <div class="pl-2">
                <h3 class="font-bold text-slate-800 text-base leading-tight">{{ $p->nama }}</h3>
                <p class="text-xs font-medium text-blue-600 mb-1">{{ $p->kode_pelanggan }} • {{ ucfirst($p->jenis_pelanggan) }}</p>
                <p class="text-xs text-slate-500 line-clamp-1">{{ $p->alamat }}</p>
            </div>
            
            <div class="text-right">
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $p->status === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $p->status }}
                </span>
            </div>
        </div>
        @empty
        <div class="text-center py-10 text-slate-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 mx-auto mb-2 opacity-50">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            <p>Tidak ada pelanggan yang sesuai.</p>
        </div>
        @endforelse

        <!-- Pagination -->
        @if($pelanggans->hasPages())
        <div class="pt-4 pb-2">
            {{ $pelanggans->links('livewire::simple-tailwind') }}
        </div>
        @endif
    </div>

    <!-- Floating Action Button (FAB) -->
    <a href="#" class="fixed bottom-20 right-4 w-14 h-14 bg-blue-700 text-white rounded-full flex items-center justify-center shadow-[0_8px_16px_rgba(29,78,216,0.4)] hover:bg-blue-800 active:scale-95 transition-transform z-30">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-7 h-7">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
    </a>
</div>
