<div>
    @if (session()->has('success'))
        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm rounded-r-xl">
            <p class="font-bold">Sukses</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-sm rounded-r-xl">
            <p class="font-bold">Gagal</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <!-- Card Saldo Belum Disetor -->
    <div class="bg-gradient-to-br from-blue-700 to-indigo-800 rounded-2xl shadow-lg p-6 mb-6 text-white relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-white opacity-10 rounded-full"></div>
        <div class="absolute right-12 -bottom-10 w-32 h-32 bg-white opacity-10 rounded-full"></div>

        <p class="text-blue-200 text-sm font-medium mb-1">Kas di Tangan (Belum Disetor)</p>
        <h2 class="text-3xl font-black mb-1">Rp {{ number_format($totalUnremitted, 0, ',', '.') }}</h2>
        <p class="text-blue-200 text-sm mb-6">Berasal dari {{ $countUnremitted }} transaksi pembayaran tunai.</p>

        @if($countUnremitted > 0)
        <button wire:click="buatSetoran" wire:confirm="Anda yakin akan menyetorkan sejumlah Rp {{ number_format($totalUnremitted, 0, ',', '.') }} ke Bendahara?" class="w-full bg-white text-blue-800 font-bold py-3 px-4 rounded-xl shadow-md hover:bg-slate-50 transition active:scale-95 flex items-center justify-center space-x-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-5 h-5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
            </svg>
            <span>Setorkan Uang ke Bendahara</span>
        </button>
        @else
        <button disabled class="w-full bg-blue-800/50 text-blue-300 font-bold py-3 px-4 rounded-xl cursor-not-allowed">
            Tidak ada kas untuk disetor
        </button>
        @endif
    </div>

    <!-- Riwayat Setoran -->
    <h3 class="font-bold text-slate-800 mb-4 px-1">Riwayat Setoran Terakhir</h3>
    <div class="space-y-3">
        @forelse($riwayatSetoran as $setoran)
            <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-100 flex justify-between items-center">
                <div>
                    <p class="font-bold text-slate-800">Rp {{ number_format($setoran->total_setoran, 0, ',', '.') }}</p>
                    <p class="text-xs text-slate-500">{{ \Carbon\Carbon::parse($setoran->tanggal)->format('d M Y') }} • {{ $setoran->jumlah_transaksi }} Transaksi</p>
                </div>
                <div class="text-right">
                    @if($setoran->status === 'menunggu_konfirmasi')
                        <span class="inline-flex bg-amber-100 text-amber-700 px-2 py-1 rounded text-xs font-bold uppercase tracking-wide">Menunggu</span>
                    @elseif($setoran->status === 'diterima')
                        <span class="inline-flex bg-green-100 text-green-700 px-2 py-1 rounded text-xs font-bold uppercase tracking-wide">Diterima</span>
                    @else
                        <span class="inline-flex bg-slate-100 text-slate-700 px-2 py-1 rounded text-xs font-bold uppercase tracking-wide">{{ $setoran->status }}</span>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-8 text-slate-500">
                Belum ada riwayat setoran uang.
            </div>
        @endforelse
    </div>
</div>
