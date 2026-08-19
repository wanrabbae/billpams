<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h2 class="text-xl font-bold text-slate-800 mb-6">Input Meter Air Pelanggan</h2>

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

        <form wire:submit="save">
        @if(Auth::user()->role === "pengawas")
            <div class="mb-4 bg-orange-100 text-orange-700 p-3 rounded text-sm font-medium border border-orange-200">ℹ️ Anda masuk sebagai Pengawas (Read-Only). Anda tidak dapat menyimpan data meter.</div>
        @endif
            <div class="space-y-4">
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Pelanggan</label>
                    <select wire:model.live="pelanggan_id" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $p)
                            <option value="{{ $p->id }}">{{ $p->kode_pelanggan }} - {{ $p->nama }} ({{ ucfirst($p->jenis_pelanggan) }})</option>
                        @endforeach
                    </select>
                    @error('pelanggan_id') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Periode Tagihan</label>
                    <input type="month" wire:model="periode" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                    @error('periode') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Meter Awal (m³)</label>
                        <input type="number" wire:model.live.debounce.500ms="meter_awal" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-slate-50">
                        @error('meter_awal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Meter Akhir (m³)</label>
                        <input type="number" wire:model.live.debounce.500ms="meter_akhir" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('meter_akhir') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100 flex justify-between items-center">
                    <span class="text-blue-800 font-medium">Total Pemakaian:</span>
                    <span class="text-2xl font-bold text-blue-900">{{ $pemakaian }} m³</span>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Upload Foto Meter (Opsional)</label>
                    <input type="file" wire:model="foto_meter" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200">
                    <div wire:loading wire:target="foto_meter" class="text-sm text-blue-500 mt-1">Mengunggah foto...</div>
                    @error('foto_meter') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    
                    @if ($foto_meter)
                        <div class="mt-2">
                            <img src="{{ $foto_meter->temporaryUrl() }}" class="h-32 object-cover rounded-lg border">
                        </div>
                    @endif
                </div>

            </div>
            
            <div class="mt-8">
                <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-3 px-4 rounded-lg transition shadow-sm" wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="save">Simpan Catat Meter & Hitung Tagihan</span>
                    <span wire:loading wire:target="save">Menyimpan...</span>
                </button>
            </div>
        </form>
    </div>
</div>
