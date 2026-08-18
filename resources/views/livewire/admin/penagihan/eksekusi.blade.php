<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h2 class="text-xl font-bold text-slate-800 mb-6">Konfirmasi Tindakan Lapangan (Pencabutan)</h2>

        @if (session()->has('error'))
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        @endif

        <div class="bg-red-50 p-4 border border-red-100 rounded-lg mb-6">
            <h3 class="font-bold text-red-900 mb-2">Informasi Target Pencabutan</h3>
            <p class="text-sm text-red-800 mb-1"><strong>Nama:</strong> {{ $pelanggan->nama }} ({{ $pelanggan->kode_pelanggan }})</p>
            <p class="text-sm text-red-800 mb-1"><strong>Alamat:</strong> {{ $pelanggan->alamat }}</p>
            <p class="text-sm text-red-800"><strong>Tunggakan:</strong> {{ $pelanggan->tagihans_count }} Bulan</p>
        </div>

        <form wire:submit="simpanEksekusi">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Eksekusi Cabut</label>
                    <input type="date" wire:model="tanggal_eksekusi" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none">
                    @error('tanggal_eksekusi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Catatan / Laporan Lapangan</label>
                    <textarea wire:model="catatan" rows="3" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-red-500 outline-none" placeholder="Contoh: Pipa telah diputus dan disegel. Penghuni rumah tidak ada..."></textarea>
                    @error('catatan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Upload Bukti Foto Pencabutan</label>
                    <input type="file" wire:model="foto_bukti" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 border rounded-lg">
                    <div wire:loading wire:target="foto_bukti" class="text-sm text-blue-500 mt-1">Mengunggah foto...</div>
                    @error('foto_bukti') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    
                    @if ($foto_bukti)
                        <div class="mt-2">
                            <img src="{{ $foto_bukti->temporaryUrl() }}" class="h-32 object-cover rounded-lg border border-slate-300 shadow-sm">
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="mt-8 flex space-x-3">
                <a href="{{ route('admin.penagihan.index') }}" class="w-1/3 bg-slate-100 hover:bg-slate-200 text-slate-800 font-medium py-3 px-4 rounded-lg text-center transition">Batal</a>
                <button type="submit" class="w-2/3 bg-red-600 hover:bg-red-700 text-white font-medium py-3 px-4 rounded-lg transition shadow-sm flex items-center justify-center space-x-2" wire:loading.attr="disabled">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" /></svg>
                    <span wire:loading.remove wire:target="simpanEksekusi">Konfirmasi Cabut Meteran</span>
                    <span wire:loading wire:target="simpanEksekusi">Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>
