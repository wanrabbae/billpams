<div>
    @if (session()->has('error'))
        <div class="mb-4 bg-red-100 border-l-4 border-red-500 text-red-700 p-4 shadow-sm rounded-r-xl">
            <p class="font-bold">Perhatian</p>
            <p>{{ session('error') }}</p>
        </div>
    @endif

    @if(!$transaksiSukses && !$tagihan)
        <!-- Pencarian Tagihan -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5 mb-4" x-data="qrScanner()">
            <div class="flex justify-between items-center mb-4">
                <h2 class="font-bold text-slate-800">Cari Tagihan Belum Lunas</h2>
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

            <form wire:submit="cariTagihan">
                <div class="relative mb-4">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                        </svg>
                    </div>
                    <input type="text" wire:model.defer="search" class="w-full bg-slate-50 border border-slate-300 text-slate-900 text-base rounded-xl pl-10 p-3 outline-none focus:ring-2 focus:ring-blue-500" placeholder="Kode atau Nama Pelanggan" required>
                </div>
                <button type="submit" class="w-full bg-blue-700 text-white font-bold py-3 rounded-xl hover:bg-blue-800 transition active:scale-95">
                    Cari Tagihan
                </button>
            </form>
        </div>
    @endif

    @if($tagihan)
        <!-- Form Pembayaran -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
            <div class="bg-blue-50 p-4 border-b border-blue-100 flex justify-between items-center">
                <div>
                    <p class="font-bold text-blue-900 text-lg">{{ $tagihan->pelanggan->nama }}</p>
                    <p class="text-sm text-blue-700">{{ $tagihan->pelanggan->kode_pelanggan }} | Periode {{ date('M Y', strtotime($tagihan->periode)) }}</p>
                </div>
                <button wire:click="$set('tagihan', null)" class="text-red-500 font-bold bg-white px-3 py-1 border border-red-100 rounded shadow-sm text-sm">Batal</button>
            </div>

            <div class="p-4">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-slate-500 text-sm">Pemakaian (m³)</span>
                    <span class="font-bold text-slate-800">{{ $tagihan->pemakaian }} m³</span>
                </div>
                
                <div class="flex justify-between items-center mb-6 py-3 border-y border-dashed border-slate-300 bg-slate-50 px-2 rounded">
                    <span class="text-slate-600 font-bold">TOTAL TAGIHAN</span>
                    <span class="font-black text-blue-700 text-2xl">Rp {{ number_format($tagihan->total, 0, ',', '.') }}</span>
                </div>

                <form wire:submit="prosesBayar">
                    <div class="mb-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Uang Diterima (Rp)</label>
                        <input type="number" wire:model.live.debounce.300ms="uang_diterima" class="w-full bg-white border-2 border-slate-300 text-slate-900 text-xl font-bold rounded-xl p-3 outline-none focus:ring-4 focus:ring-green-100 focus:border-green-500 text-right font-mono" required min="{{ $tagihan->total }}">
                    </div>

                    <div class="flex justify-between items-center mb-6 bg-green-50 p-3 rounded-lg border border-green-200">
                        <span class="text-green-800 font-medium">Kembalian</span>
                        <span class="font-black text-green-700 text-xl">Rp {{ number_format($kembalian, 0, ',', '.') }}</span>
                    </div>

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 active:bg-green-800 text-white font-bold py-4 rounded-xl transition shadow-lg text-lg flex items-center justify-center space-x-2" wire:loading.attr="disabled">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                        <span wire:loading.remove wire:target="prosesBayar">Bayar & Cetak Kwitansi</span>
                        <span wire:loading wire:target="prosesBayar">Memproses...</span>
                    </button>
                </form>
            </div>
        </div>
    @endif

    @if($transaksiSukses)
        <!-- Sukses Transaksi -->
        <div class="bg-white rounded-xl shadow-sm border border-green-200 p-6 text-center mb-6 relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-2 bg-green-500"></div>
            <div class="w-16 h-16 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="3" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                </svg>
            </div>
            <h2 class="text-xl font-bold text-slate-800 mb-1">Pembayaran Berhasil!</h2>
            <p class="text-slate-500 mb-6 text-sm">No Kwitansi: <strong class="text-slate-800 font-mono">{{ $transaksiSukses['no_kwitansi'] }}</strong></p>

            <button type="button" onclick="printReceipt()" class="w-full bg-blue-100 text-blue-700 hover:bg-blue-200 font-bold py-3 rounded-xl transition mb-3 flex items-center justify-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0v2.796c0 .121.08.232.197.247a47.865 47.865 0 0010.106 0 .25.25 0 00.197-.247V7.031c0-.121-.08-.232-.197-.247m-10.5 0a48.536 48.536 0 0110.5 0" />
                </svg>
                <span>Cetak Ulang Struk (Bluetooth)</span>
            </button>
            
            <button wire:click="$set('transaksiSukses', null)" class="w-full border-2 border-slate-200 text-slate-700 font-bold py-3 rounded-xl hover:bg-slate-50 transition">
                Kembali
            </button>
        </div>
    @endif

    <!-- Script Web Bluetooth API ESC/POS -->
    @script
    <script>
        let currentStruk = null;
        let tenantInfo = null;

        $wire.on('print-struk', (e) => {
            currentStruk = e.strukData;
            tenantInfo = e.tenant;
            printReceipt(); // Auto trigger print prompt
        });

        window.printReceipt = async function() {
            if (!currentStruk || !tenantInfo) return;
            
            try {
                // Request Bluetooth Device that supports serial communication
                const device = await navigator.bluetooth.requestDevice({
                    filters: [
                        { services: ['000018f0-0000-1000-8000-00805f9b34fb'] } // Common standard BLE service for thermal printers
                    ],
                    optionalServices: ['e7810a71-73ae-499d-8c15-faa9aef0c3f2']
                });

                console.log('Connecting to GATT Server...');
                const server = await device.gatt.connect();

                console.log('Getting Service...');
                const service = await server.getPrimaryService('000018f0-0000-1000-8000-00805f9b34fb');

                console.log('Getting Characteristic...');
                const characteristic = await service.getCharacteristic('00002af1-0000-1000-8000-00805f9b34fb');

                // Build ESC/POS Data
                const escposData = buildEscPosStruk(currentStruk, tenantInfo);
                
                // Print in chunks (BLE usually has a 20 or 512 byte limit per chunk)
                await sendDataInChunks(characteristic, escposData);

                alert('Cetak struk berhasil dikirim ke printer!');
            } catch (error) {
                console.error('Bluetooth Print Error:', error);
                if(error.name === 'NotFoundError' || error.name === 'SecurityError') {
                    alert('Printer tidak ditemukan atau Browser tidak memiliki izin Bluetooth. Pastikan lokasi / Bluetooth aktif.');
                } else {
                    alert('Gagal mencetak: ' + error.message);
                }
            }
        };

        function buildEscPosStruk(data, tenant) {
            const ESC = '\x1B';
            const GS = '\x1D';
            const INIT = ESC + '@'; // Initialize printer
            const CENTER = ESC + 'a' + '\x01'; // Center align
            const LEFT = ESC + 'a' + '\x00'; // Left align
            const BOLD_ON = ESC + 'E' + '\x01';
            const BOLD_OFF = ESC + 'E' + '\x00';
            const LF = '\n';

            let struk = INIT + CENTER + BOLD_ON;
            struk += 'HIPPAMS - ' + tenant.name + LF;
            struk += BOLD_OFF + tenant.address + LF;
            struk += '================================' + LF;
            struk += BOLD_ON + 'BUKTI PEMBAYARAN' + BOLD_OFF + LF;
            struk += LEFT;
            struk += 'No       : ' + data.no_kwitansi + LF;
            struk += 'Tanggal  : ' + data.tanggal + LF;
            struk += 'Petugas  : ' + data.petugas + LF;
            struk += '--------------------------------' + LF;
            struk += 'Kode Plg : ' + data.kode_plg + LF;
            struk += 'Nama     : ' + data.nama_plg + LF;
            struk += 'Alamat   : ' + data.alamat_plg + LF;
            struk += 'Jenis    : ' + data.jenis_plg + LF;
            struk += '--------------------------------' + LF;
            struk += 'Periode  : ' + data.periode + LF;
            struk += 'Meter    : ' + data.meter + LF;
            struk += 'Pemakaian: ' + data.pemakaian + LF;
            struk += 'Tarif    : ' + data.tarif + LF;
            struk += '--------------------------------' + LF;
            struk += 'Tagihan  : ' + data.tagihan + LF;
            struk += 'Dibayar  : ' + data.dibayar + LF;
            struk += BOLD_ON + 'TOTAL    : ' + data.total + BOLD_OFF + LF;
            struk += BOLD_ON + 'STATUS   : LUNAS' + BOLD_OFF + LF;
            struk += '================================' + LF;
            struk += CENTER + 'Terima kasih atas pembayaran Anda' + LF;
            struk += 'Air Bersih untuk Kehidupan Sehat' + LF;
            struk += LF + LF + LF + LF; // Feed paper

            const encoder = new TextEncoder();
            return encoder.encode(struk);
        }

        async function sendDataInChunks(characteristic, data) {
            const chunkSize = 512;
            for (let i = 0; i < data.length; i += chunkSize) {
                const chunk = data.slice(i, i + chunkSize);
                await characteristic.writeValue(chunk);
                // Sleep small amount to prevent buffer overflow on printer
                await new Promise(r => setTimeout(r, 100)); 
            }
        }
    </script>
    @endscript

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
                            @this.call('cariTagihan');
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
