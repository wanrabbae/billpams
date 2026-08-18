<div>
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-blue-100 p-6 flex flex-col items-center text-center">
            <span class="text-sm font-semibold text-blue-600 mb-1">TOTAL PELANGGAN</span>
            <span class="text-4xl font-bold text-slate-800">{{ $totalPelanggan }}</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-green-100 p-6 flex flex-col items-center text-center">
            <span class="text-sm font-semibold text-green-600 mb-1">PELANGGAN AKTIF</span>
            <span class="text-4xl font-bold text-slate-800">{{ $pelangganAktif }}</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-red-100 p-6 flex flex-col items-center text-center">
            <span class="text-sm font-semibold text-red-500 mb-1">TOTAL PIUTANG WARGA</span>
            <span class="text-xl font-bold text-slate-800 mt-2">Rp {{ number_format($totalPiutang, 0, ',', '.') }}</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-indigo-100 p-6 flex flex-col items-center text-center">
            <span class="text-sm font-semibold text-indigo-600 mb-1">SALDO KAS (ALL TIME)</span>
            <span class="text-xl font-bold text-slate-800 mt-2">Rp {{ number_format($saldoKas, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Keuangan -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Ringkasan Bulan Ini ({{ date('F Y') }})</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-slate-500">Pemasukan</span>
                    <span class="font-semibold text-green-600">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-slate-500">Pengeluaran</span>
                    <span class="font-semibold text-red-500">Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center border-b pb-2">
                    <span class="text-slate-500">Tagihan Terbit (Belum Lunas)</span>
                    <span class="font-bold text-amber-600">Rp {{ number_format($bulanIniBelumBayar, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between items-center bg-orange-50 rounded p-2">
                    <span class="text-orange-600 text-sm font-medium">Subsidi Sosial Tersalur</span>
                    <span class="font-bold text-orange-600 text-sm">Rp {{ number_format($subsidiSosial, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Chart (2 columns wide) -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 lg:col-span-2">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Grafik Keuangan Bulanan</h3>
            <canvas id="financeChart" height="100"></canvas>
        </div>
    </div>

    <!-- Quick Actions -->
    <h3 class="text-lg font-bold text-slate-800 mb-4">Aksi Cepat</h3>
    <div class="flex flex-wrap gap-4">
        <a href="{{ route('admin.meter.create') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 px-6 rounded-lg transition shadow-sm text-sm">Catat Meter</a>
        <a href="{{ route('admin.keuangan.setoran') }}" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium py-2 px-6 rounded-lg transition shadow-sm text-sm">Validasi Setoran</a>
        <a href="{{ route('admin.pelanggan.index') }}" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium py-2 px-6 rounded-lg transition shadow-sm text-sm">Kelola Pelanggan</a>
    </div>

    <script>
        document.addEventListener('livewire:initialized', () => {
            const ctx = document.getElementById('financeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($chartLabels),
                    datasets: [
                        {
                            label: 'Pemasukan (Rp)',
                            data: @json($chartPemasukan),
                            backgroundColor: '#16A34A',
                        },
                        {
                            label: 'Pengeluaran (Rp)',
                            data: @json($chartPengeluaran),
                            backgroundColor: '#EF4444',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</div>
