<div>
    @if (session()->has('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('success') }}
        </div>
    @endif

    @if($showForm)
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl mb-6">
            <h2 class="text-xl font-bold text-slate-800 mb-6">Catat {{ ucfirst($formType) }} Kas</h2>
            <form wire:submit.prevent="simpanTransaksi">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label>
                        <input type="date" wire:model="tanggal" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
                        @error('tanggal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Kategori</label>
                        <input type="text" wire:model="kategori" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="{{ $formType === 'pengeluaran' ? 'Listrik Pompa, Pipa, Honor...' : 'Hibah, Bantuan...' }}">
                        @error('kategori') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">{{ $formType === 'pemasukan' ? 'Sumber / Dari Siapa' : 'Keterangan / Keperluan' }}</label>
                        <input type="text" wire:model="deskripsi" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Tuliskan keterangan rinci...">
                        @error('deskripsi') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Nominal (Rp)</label>
                        <input type="number" wire:model="nominal" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: 150000">
                        @error('nominal') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Upload Bukti (Opsional)</label>
                        <input type="file" wire:model="bukti" accept="image/*" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-slate-100 file:text-slate-700 hover:file:bg-slate-200 border rounded-lg">
                        <div wire:loading wire:target="bukti" class="text-sm text-blue-500 mt-1">Mengunggah foto...</div>
                        @error('bukti') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        @if ($bukti)
                            <div class="mt-2"><img src="{{ $bukti->temporaryUrl() }}" class="h-24 object-cover rounded shadow-sm border border-slate-300"></div>
                        @endif
                    </div>
                </div>
                <div class="mt-6 flex space-x-3">
                    <button type="button" wire:click="closeForm" class="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition" wire:loading.attr="disabled">Simpan Data</button>
                </div>
            </form>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200">
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wider mb-1">Saldo Awal Bulan</p>
            <h3 class="text-lg font-bold text-slate-700">Rp {{ number_format($kas['saldoAwal'], 0, ',', '.') }}</h3>
        </div>
        <div class="bg-green-50 p-4 rounded-xl shadow-sm border border-green-200">
            <p class="text-xs text-green-600 font-bold uppercase tracking-wider mb-1">Pemasukan (+)</p>
            <h3 class="text-lg font-bold text-green-700">Rp {{ number_format($kas['totalMasuk'], 0, ',', '.') }}</h3>
        </div>
        <div class="bg-red-50 p-4 rounded-xl shadow-sm border border-red-200">
            <p class="text-xs text-red-600 font-bold uppercase tracking-wider mb-1">Pengeluaran (-)</p>
            <h3 class="text-lg font-bold text-red-700">Rp {{ number_format($kas['totalKeluar'], 0, ',', '.') }}</h3>
        </div>
        <div class="bg-blue-600 p-4 rounded-xl shadow-sm border border-blue-700 text-white">
            <p class="text-xs text-blue-200 font-bold uppercase tracking-wider mb-1">Saldo Akhir (Real Time)</p>
            <h3 class="text-2xl font-black">Rp {{ number_format($kas['saldoAkhir'], 0, ',', '.') }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-200 bg-slate-50 flex flex-wrap justify-between items-center gap-4">
            <div class="flex items-center space-x-3">
                <select wire:model.live="bulan" class="px-3 py-2 border border-slate-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                    @foreach(range(1, 12) as $m)
                        <option value="{{ str_pad($m, 2, '0', STR_PAD_LEFT) }}">{{ date('F', mktime(0, 0, 0, $m, 10)) }}</option>
                    @endforeach
                </select>
                <select wire:model.live="tahun" class="px-3 py-2 border border-slate-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500 font-medium">
                    @for($i = date('Y') - 2; $i <= date('Y'); $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="flex space-x-2">
                <button wire:click="openForm('pemasukan')" class="px-3 py-2 border border-green-300 bg-green-50 text-green-700 text-sm font-medium rounded-lg hover:bg-green-100 transition shadow-sm">
                    + Pemasukan
                </button>
                <button wire:click="openForm('pengeluaran')" class="px-3 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition shadow-sm">
                    - Pengeluaran
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b">
                    <tr>
                        <th class="px-6 py-4">Tgl</th>
                        <th class="px-6 py-4">Keterangan</th>
                        <th class="px-6 py-4 text-right">Masuk (Debit)</th>
                        <th class="px-6 py-4 text-right">Keluar (Kredit)</th>
                        <th class="px-6 py-4 text-right">Saldo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <tr class="bg-slate-50">
                        <td class="px-6 py-3 font-bold text-slate-500 text-center" colspan="4">SALDO AWAL BULAN INI</td>
                        <td class="px-6 py-3 text-right font-bold text-slate-700">Rp {{ number_format($kas['saldoAwal'], 0, ',', '.') }}</td>
                    </tr>
                    @forelse($kas['transaksi'] as $row)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-3">
                                <div class="font-bold text-slate-700">{{ \Carbon\Carbon::parse($row['tanggal'])->format('d/m/Y') }}</div>
                                <div class="text-[10px] text-slate-400">{{ $row['id'] }}</div>
                            </td>
                            <td class="px-6 py-3">
                                <div class="font-bold text-slate-800">{{ $row['kategori'] }}</div>
                                <div class="text-xs text-slate-500">{{ $row['deskripsi'] }}</div>
                                <div class="text-[10px] text-slate-400 mt-1">Oleh: {{ $row['petugas'] }}</div>
                            </td>
                            <td class="px-6 py-3 text-right font-medium text-green-600">
                                {{ $row['debit'] > 0 ? 'Rp ' . number_format($row['debit'], 0, ',', '.') : '-' }}
                            </td>
                            <td class="px-6 py-3 text-right font-medium text-red-600">
                                {{ $row['kredit'] > 0 ? 'Rp ' . number_format($row['kredit'], 0, ',', '.') : '-' }}
                            </td>
                            <td class="px-6 py-3 text-right font-bold text-slate-700">
                                Rp {{ number_format($row['saldo'], 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                Tidak ada transaksi pada bulan ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
