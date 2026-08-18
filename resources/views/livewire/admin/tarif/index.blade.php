<div>
    @if (session()->has('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    @if($showForm)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl">
            <h2 class="text-xl font-bold text-slate-800 mb-6">{{ $tarifId ? 'Edit Tarif' : 'Tambah Tarif Baru' }}</h2>
            
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Pelanggan</label>
                        <select wire:model="jenis_pelanggan" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="umum">Umum</option>
                            <option value="sosial">Sosial</option>
                            <option value="industri">Industri</option>
                        </select>
                        @error('jenis_pelanggan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Status</label>
                        <select wire:model="status" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Nonaktif</option>
                        </select>
                        @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tarif Dasar per m³ (Rp)</label>
                        <input type="number" wire:model="tarif" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Misal: 2000">
                        @error('tarif') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Batas Gratis (m³)</label>
                        <input type="number" wire:model="batas_gratis" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Misal: 0">
                        <span class="text-xs text-slate-500">Isi 0 jika tidak ada gratis pemakaian awal.</span>
                        @error('batas_gratis') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tarif Kelebihan per m³ (Rp)</label>
                        <input type="number" wire:model="tarif_kelebihan" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Misal: 0">
                        <span class="text-xs text-slate-500">Opsional, jika setelah batas tertentu harga berbeda.</span>
                        @error('tarif_kelebihan') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Berlaku (Effective Date)</label>
                        <input type="date" wire:model="effective_date" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('effective_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-6 flex space-x-3">
                    <button type="button" wire:click="cancel" class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Simpan Tarif</button>
                </div>
            </form>
        </div>
    @else
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="p-4 border-b border-slate-200 bg-slate-50 flex justify-between items-center">
                <h2 class="font-bold text-slate-800">Daftar Tarif Aktif & Historis</h2>
                <button wire:click="create" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition shadow-sm">
                    + Tambah Tarif
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b">
                        <tr>
                            <th class="px-6 py-4">Jenis Pelanggan</th>
                            <th class="px-6 py-4 text-right">Tarif Dasar (Rp)</th>
                            <th class="px-6 py-4 text-center">Batas Gratis (m³)</th>
                            <th class="px-6 py-4 text-right">Tarif Kelebihan (Rp)</th>
                            <th class="px-6 py-4 text-center">Mulai Berlaku</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200">
                        @forelse($tarifs as $t)
                            <tr class="hover:bg-slate-50">
                                <td class="px-6 py-4 font-bold text-slate-800 uppercase">{{ $t->jenis_pelanggan }}</td>
                                <td class="px-6 py-4 text-right font-medium text-slate-700">Rp {{ number_format($t->tarif, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center">{{ $t->batas_gratis }}</td>
                                <td class="px-6 py-4 text-right">Rp {{ number_format($t->tarif_kelebihan, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-center">{{ \Carbon\Carbon::parse($t->effective_date)->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($t->status === 'aktif')
                                        <span class="inline-flex bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-bold">Aktif</span>
                                    @else
                                        <span class="inline-flex bg-slate-100 text-slate-600 px-2 py-1 rounded text-xs font-bold">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <button wire:click="edit({{ $t->id }})" class="text-blue-600 hover:text-blue-900 font-medium text-xs border border-blue-200 bg-blue-50 hover:bg-blue-100 px-3 py-1 rounded">Edit</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-500">
                                    Belum ada data tarif air yang dikonfigurasi.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
