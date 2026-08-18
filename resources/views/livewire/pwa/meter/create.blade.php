<div>
    @if (session()->has('success'))
        <div class="mb-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 shadow-sm rounded-r-xl" role="alert">
            <p class="font-bold">Sukses</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-sm rounded-r-xl" role="alert">
            <p class="font-bold">Gagal</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    <form wire:submit="save">
        <!-- Pencarian Pelanggan -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-4" x-data="qrScanner()">
            <div class="flex justify-between items-center mb-2">
                <label class="block text-sm font-bold text-slate-700">Pilih Pelanggan</label>
                <button type="button" @click="startScanner" class="text-xs bg-emerald-100 text-emerald-700 font-bold px-3 py-1 rounded-full border border-emerald-200 flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                    Scan QR
                </button>
            </div>

            <!-- QR Reader Container -->
            <div x-show="scanning" class="mb-4 rounded-xl overflow-hidden border-2 border-emerald-500 relative" style="display: none;">
                <div id="reader" width="100%"></div>
                <button type="button" @click="stopScanner" class="absolute top-2 right-2 bg-red-600 text-white p-1 rounded-full text-xs z-10 shadow">
                    Tutup
                </button>
            </div>
            
            @if(!$pelanggan_id)
                <div class="relative mb-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" /></svg>
                    </div>
                    <input type="text" wire:model.live.debounce.500ms="search" class="bg-slate-50 border border-slate-300 text-slate-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3 outline-none" placeholder="Cari nama / kode (min 2 huruf)...">
                </div>

                @if(count($pelanggans) > 0)
                    <ul class="divide-y divide-slate-100 border border-slate-100 rounded-lg overflow-hidden">
                        @foreach($pelanggans as $p)
                            <li wire:click="$set('pelanggan_id', {{ $p->id }})" class="p-3 hover:bg-blue-50 cursor-pointer flex justify-between items-center transition">
                                <div>
                                    <span class="block font-bold text-slate-800 text-sm">{{ $p->nama }}</span>
                                    <span class="block text-xs text-slate-500">{{ $p->kode_pelanggan }} | {{ ucfirst($p->jenis_pelanggan) }}</span>
                                </div>
                                <span class="text-blue-600 font-bold text-xl">›</span>
                            </li>
                        @endforeach
                    </ul>
                @elseif(strlen($search) >= 2)
                    <p class="text-sm text-red-500 text-center py-2">Pelanggan tidak ditemukan.</p>
                @endif
            @else
                <!-- Selected Pelanggan Info -->
                @php $selected = \App\Models\Pelanggan::find($pelanggan_id); @endphp
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex justify-between items-center">
                    <div>
                        <p class="font-bold text-blue-900 text-lg">{{ $selected->nama }}</p>
                        <p class="text-sm text-blue-700">{{ $selected->kode_pelanggan }} | {{ ucfirst($selected->jenis_pelanggan) }}</p>
                    </div>
                    <button type="button" wire:click="$set('pelanggan_id', null)" class="text-red-500 text-sm font-bold bg-white px-2 py-1 rounded shadow-sm border border-red-100">Ganti</button>
                </div>
            @endif
            @error('pelanggan_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
        </div>

        @if($pelanggan_id)
        <!-- Input Meter -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-4">
            <h3 class="text-sm font-bold text-slate-700 mb-4 border-b pb-2">Stand Meter Air</h3>
            
            <div class="flex items-center justify-between mb-4">
                <label class="text-slate-500 font-medium text-sm">Bulan Periode</label>
                <input type="month" wire:model="periode" class="bg-slate-50 border border-slate-200 rounded px-2 py-1 text-sm outline-none font-bold text-slate-700">
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Meter Lalu</label>
                    <input type="number" wire:model="meter_awal" class="w-full bg-slate-100 border border-slate-200 text-slate-500 rounded-xl p-3 text-lg font-mono outline-none" readonly>
                </div>
                <div>
                    <label class="block text-xs font-bold text-blue-600 uppercase tracking-wider mb-1">Meter Skrg</label>
                    <input type="number" wire:model.live.debounce.300ms="meter_akhir" inputmode="numeric" class="w-full bg-white border-2 border-blue-400 text-slate-900 rounded-xl p-3 text-xl font-bold font-mono outline-none focus:ring-4 focus:ring-blue-100 transition shadow-inner">
                </div>
            </div>
            @error('meter_akhir') <p class="text-red-500 text-xs mb-4 -mt-2">{{ $message }}</p> @enderror

            <!-- Auto Calculate Banner -->
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 rounded-xl p-4 text-white flex justify-between items-center shadow-md">
                <span class="font-medium">Total Pakai</span>
                <span class="text-3xl font-black font-mono tracking-tight">{{ $pemakaian }} <span class="text-base font-medium opacity-80">m³</span></span>
            </div>
        </div>

        <!-- Kamera / Upload -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 mb-6">
            <label class="block text-sm font-bold text-slate-700 mb-2">Foto Meteran</label>
            
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-xl cursor-pointer bg-slate-50 hover:bg-slate-100 overflow-hidden relative">
                    @if($foto_meter)
                        <img src="{{ $foto_meter->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover">
                    @else
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-3 text-slate-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/></svg>
                            <p class="text-sm text-slate-500 font-semibold">Ambil Foto / Pilih Galeri</p>
                        </div>
                    @endif
                    <input id="dropzone-file" type="file" accept="image/*" capture="environment" wire:model="foto_meter" class="hidden" />
                </label>
            </div>
            <div wire:loading wire:target="foto_meter" class="text-sm text-blue-500 mt-2 font-medium text-center">Menyiapkan foto...</div>
            @error('foto_meter') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        <!-- Tombol Simpan -->
        <button type="submit" class="w-full bg-blue-700 active:bg-blue-800 text-white font-bold py-4 rounded-xl transition shadow-lg text-lg tracking-wide" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="save">Simpan Data</span>
            <span wire:loading wire:target="save">Menyimpan...</span>
        </button>
        @endif
    </form>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('qrScanner', () => ({
                scanning: false,
                html5QrcodeScanner: null,

                startScanner() {
                    this.scanning = true;
                    this.$nextTick(() => {
                        this.html5QrcodeScanner = new Html5QrcodeScanner(
                            "reader", { fps: 10, qrbox: 250, aspectRatio: 1.0 }
                        );
                        this.html5QrcodeScanner.render((decodedText, decodedResult) => {
                            // decodedText is the kode_pelanggan
                            @this.set('search', decodedText);
                            this.stopScanner();
                        }, (error) => {
                            // ignore background scan errors
                        });
                    });
                },

                stopScanner() {
                    if (this.html5QrcodeScanner) {
                        this.html5QrcodeScanner.clear().then(() => {
                            this.scanning = false;
                        }).catch(error => {
                            console.error("Failed to clear html5QrcodeScanner. ", error);
                            this.scanning = false;
                        });
                    } else {
                        this.scanning = false;
                    }
                }
            }));
        });
    </script>
</div>
