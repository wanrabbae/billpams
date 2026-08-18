<div class="max-w-xl mx-auto py-12 px-4 sm:px-6">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold text-blue-700 tracking-tight">HIPPAMS</h1>
        <p class="text-slate-500 mt-2">Portal Publik Pengecekan Tagihan Air</p>
    </div>

    <!-- Form Search -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 mb-8">
        <form wire:submit="cekTagihan">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pilih HIPPAM / PAMSIMAS</label>
                    <select wire:model="tenant_id" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">-- Pilih --</option>
                        @foreach($tenants as $t)
                            <option value="{{ $t->id }}">{{ $t->name }} ({{ $t->village }})</option>
                        @endforeach
                    </select>
                    @error('tenant_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kode Pelanggan</label>
                    <input type="text" wire:model="kode_pelanggan" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-blue-500 outline-none placeholder:text-slate-300" placeholder="Contoh: UM-2026-001" required>
                    @error('kode_pelanggan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-3 rounded-lg transition" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="cekTagihan">Cek Tagihan Saya</span>
                    <span wire:loading wire:target="cekTagihan">Mencari Data...</span>
                </button>

                @if($errorMessage)
                    <div class="p-3 mt-4 text-sm text-red-600 bg-red-50 border border-red-200 rounded-lg">
                        {{ $errorMessage }}
                    </div>
                @endif
            </div>
        </form>
    </div>

    <!-- Hasil Query -->
    @if($pelanggan)
        <!-- Banner Tunggakan -->
        @if($tunggakanBulan >= 3)
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl flex items-start">
                <span class="text-xl mr-2">⚠</span>
                <div>
                    <strong class="font-bold block">Peringatan Keras!</strong>
                    <span class="block sm:inline">Anda memiliki tunggakan {{ $tunggakanBulan }} bulan. Status layanan: <span class="font-bold underline">SURAT PENCABUTAN</span>. Segera lunasi tagihan Anda.</span>
                </div>
            </div>
        @elseif($tunggakanBulan >= 2)
            <div class="mb-4 bg-amber-100 border border-amber-400 text-amber-800 px-4 py-3 rounded-xl flex items-start">
                <span class="text-xl mr-2">⚠</span>
                <div>
                    <strong class="font-bold block">Perhatian</strong>
                    <span class="block sm:inline">Anda memiliki tunggakan {{ $tunggakanBulan }} bulan. Status layanan: <span class="font-bold underline">SURAT TEGURAN</span>.</span>
                </div>
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50 border-b border-slate-200 px-6 py-4 flex justify-between items-center">
                <h3 class="font-bold text-slate-800">Detail Pelanggan</h3>
                <span class="px-2 py-1 text-xs font-semibold rounded-full {{ $pelanggan->status === 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ strtoupper($pelanggan->status) }}
                </span>
            </div>
            <div class="p-6">
                <p class="text-xl font-bold text-slate-900">{{ $pelanggan->nama }}</p>
                <p class="text-sm text-slate-500 mb-4">{{ $pelanggan->kode_pelanggan }} - {{ $pelanggan->alamat }}</p>

                @if($tagihanTerbaru)
                    <div class="mt-6 border-t pt-6">
                        <h4 class="font-semibold text-slate-800 mb-3">Tagihan Bulan Terakhir ({{ date('F Y', strtotime($tagihanTerbaru->periode)) }})</h4>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4 text-sm">
                            <div>
                                <p class="text-slate-500">Meter Awal</p>
                                <p class="font-medium text-slate-900">{{ $tagihanTerbaru->meter_awal }} m³</p>
                            </div>
                            <div>
                                <p class="text-slate-500">Meter Akhir</p>
                                <p class="font-medium text-slate-900">{{ $tagihanTerbaru->meter_akhir }} m³</p>
                            </div>
                            <div>
                                <p class="text-slate-500">Total Pemakaian</p>
                                <p class="font-medium text-blue-700 text-lg">{{ $tagihanTerbaru->pemakaian }} m³</p>
                            </div>
                            @if($tagihanTerbaru->subsidi > 0)
                            <div>
                                <p class="text-slate-500">Subsidi Diterima</p>
                                <p class="font-medium text-orange-500">Rp {{ number_format($tagihanTerbaru->subsidi, 0, ',', '.') }}</p>
                            </div>
                            @endif
                        </div>

                        <div class="bg-slate-50 rounded-lg p-4 flex justify-between items-center border border-slate-200">
                            <div>
                                <p class="text-slate-500 text-sm">Total Tagihan</p>
                                <p class="text-2xl font-bold text-slate-900">Rp {{ number_format($tagihanTerbaru->total, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                @if($tagihanTerbaru->status === 'lunas')
                                    <span class="inline-flex items-center bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">✓ LUNAS</span>
                                @else
                                    <span class="inline-flex items-center bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">BELUM BAYAR</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @else
                    <div class="mt-4 p-4 bg-slate-50 border rounded-lg text-center text-slate-500 text-sm">
                        Belum ada riwayat tagihan air yang tercatat untuk Anda.
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>
