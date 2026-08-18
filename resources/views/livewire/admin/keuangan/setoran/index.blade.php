<div>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        
        <!-- Toolbar -->
        <div class="p-4 border-b border-slate-200 bg-slate-50 flex flex-wrap justify-between items-center gap-4">
            <h2 class="font-bold text-slate-800">Daftar Setoran Petugas Kasir</h2>
            
            <div class="flex space-x-2">
                <select wire:model.live="filterStatus" class="px-3 py-2 border border-slate-300 rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="menunggu_konfirmasi">Menunggu Konfirmasi</option>
                    <option value="diterima">Telah Diterima</option>
                </select>
            </div>
        </div>

        @if (session()->has('success'))
            <div class="m-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="m-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                {{ session('error') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b">
                    <tr>
                        <th class="px-6 py-4">Tanggal Setor</th>
                        <th class="px-6 py-4">Petugas</th>
                        <th class="px-6 py-4 text-center">Jml Transaksi</th>
                        <th class="px-6 py-4 text-right">Total Setoran</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi Bendahara</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($setorans as $setoran)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-slate-700">
                                {{ \Carbon\Carbon::parse($setoran->created_at)->format('d M Y H:i') }}
                            </td>
                            <td class="px-6 py-4 font-bold text-slate-800">
                                {{ $setoran->petugas->name ?? 'Petugas Tidak Diketahui' }}
                            </td>
                            <td class="px-6 py-4 text-center text-slate-600">
                                {{ $setoran->jumlah_transaksi }} Struk
                            </td>
                            <td class="px-6 py-4 text-right font-bold text-blue-700">
                                Rp {{ number_format($setoran->total_setoran, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($setoran->status === 'menunggu_konfirmasi')
                                    <span class="inline-flex bg-amber-100 text-amber-800 px-2 py-1 rounded-full text-xs font-bold">Menunggu</span>
                                @elseif($setoran->status === 'diterima')
                                    <span class="inline-flex bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-bold">Diterima</span>
                                @else
                                    <span class="inline-flex bg-slate-100 text-slate-800 px-2 py-1 rounded-full text-xs font-bold">{{ $setoran->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($setoran->status === 'menunggu_konfirmasi')
                                    <button 
                                        wire:click="terimaSetoran({{ $setoran->id }})" 
                                        wire:confirm="Anda yakin telah menerima fisik uang senilai Rp {{ number_format($setoran->total_setoran, 0, ',', '.') }} dari {{ $setoran->petugas->name }}?"
                                        class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1.5 rounded shadow-sm text-xs font-medium transition">
                                        Terima Uang
                                    </button>
                                @else
                                    <span class="text-slate-400 text-xs italic">Selesai</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-slate-500">
                                Belum ada riwayat setoran dari petugas lapangan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($setorans->hasPages())
        <div class="p-4 border-t border-slate-200">
            {{ $setorans->links() }}
        </div>
        @endif
    </div>
</div>
