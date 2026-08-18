<div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <!-- Toolbar -->
        <div class="p-4 border-b border-slate-200 bg-slate-50 flex flex-wrap justify-between items-center gap-4">
            <h2 class="font-bold text-slate-800">Daftar Piutang Pelanggan</h2>
            
            <div class="flex space-x-2">
                <select wire:model.live="filterTunggakan" class="px-3 py-2 border border-slate-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Tunggakan</option>
                    <option value="1">1 Bulan (Peringatan)</option>
                    <option value="2">2 Bulan (Surat Teguran)</option>
                    <option value="3">>= 3 Bulan (Surat Pencabutan)</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b">
                    <tr>
                        <th class="px-6 py-4">Pelanggan</th>
                        <th class="px-6 py-4">Alamat</th>
                        <th class="px-6 py-4 text-center">Bulan Nunggak</th>
                        <th class="px-6 py-4 text-right">Total Piutang</th>
                        <th class="px-6 py-4 text-center">Aksi / Surat</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($pelanggans as $p)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="font-bold text-slate-800">{{ $p->nama }}</div>
                                <div class="text-xs text-slate-500">{{ $p->kode_pelanggan }}</div>
                            </td>
                            <td class="px-6 py-4 text-slate-600">{{ $p->alamat }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($p->tunggakan_count >= 3)
                                    <span class="inline-flex bg-red-100 text-red-800 px-2.5 py-0.5 rounded-full text-xs font-bold">{{ $p->tunggakan_count }} Bulan</span>
                                @elseif($p->tunggakan_count == 2)
                                    <span class="inline-flex bg-amber-100 text-amber-800 px-2.5 py-0.5 rounded-full text-xs font-bold">{{ $p->tunggakan_count }} Bulan</span>
                                @else
                                    <span class="inline-flex bg-slate-100 text-slate-800 px-2.5 py-0.5 rounded-full text-xs font-bold">{{ $p->tunggakan_count }} Bulan</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-slate-700">
                                Rp {{ number_format($p->total_tunggakan_total, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center space-x-2">
                                @if($p->tunggakan_count == 2)
                                    <a href="{{ route('admin.penagihan.surat', ['pelanggan' => $p->id, 'jenis' => 'teguran']) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white rounded text-xs font-medium transition shadow-sm">
                                        Cetak Teguran
                                    </a>
                                @elseif($p->tunggakan_count >= 3)
                                    <a href="{{ route('admin.penagihan.surat', ['pelanggan' => $p->id, 'jenis' => 'pencabutan']) }}" target="_blank" class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-medium transition shadow-sm mb-1">
                                        Cetak Cabut
                                    </a>
                                    <a href="{{ route('admin.penagihan.eksekusi', $p->id) }}" class="inline-flex items-center px-3 py-1.5 bg-slate-800 hover:bg-slate-900 text-white rounded text-xs font-medium transition shadow-sm">
                                        Eksekusi
                                    </a>
                                @else
                                    <span class="text-slate-400 text-xs italic">Belum waktunya</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-slate-500">
                                Luar biasa! Tidak ada pelanggan yang menunggak saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($pelanggans->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $pelanggans->links() }}
        </div>
        @endif
    </div>
</div>
