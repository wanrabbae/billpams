<div>
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between">
            <div class="flex items-start gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Total Pelanggan</p>
                    <h3 class="text-3xl font-black text-slate-800 leading-none">{{ $totalPelanggan }}</h3>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between text-xs font-medium">
                <span class="text-emerald-500 flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" /></svg>
                    12%
                </span>
                <span class="text-slate-400">dari bulan lalu</span>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between">
            <div class="flex items-start gap-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl relative">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    <div class="absolute -bottom-1 -right-1 bg-white rounded-full p-0.5">
                        <svg class="w-3.5 h-3.5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Pelanggan Aktif</p>
                    <h3 class="text-3xl font-black text-slate-800 leading-none">{{ $pelangganAktif }}</h3>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between text-xs font-medium">
                <span class="text-emerald-500 flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" /></svg>
                    8%
                </span>
                <span class="text-slate-400">dari bulan lalu</span>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between">
            <div class="flex items-start gap-4">
                <div class="p-3 bg-red-50 text-red-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Total Piutang Warga</p>
                    <h3 class="text-2xl font-black text-slate-800 leading-none">Rp {{ number_format($totalPiutang, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between text-xs font-medium">
                <span class="text-slate-400 flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19.5 12h-15" /></svg>
                    0%
                </span>
                <span class="text-slate-400">dari bulan lalu</span>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between">
            <div class="flex items-start gap-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Saldo Kas (All Time)</p>
                    <h3 class="text-2xl font-black text-slate-800 leading-none">Rp {{ number_format($saldoKas, 0, ',', '.') }}</h3>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between text-xs font-medium">
                <span class="text-emerald-500 flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" /></svg>
                    100%
                </span>
                <span class="text-slate-400">dari bulan lalu</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Keuangan -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <div class="flex items-center mb-6">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mr-3">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Ringkasan Bulan Ini ({{ date('F Y') }})</h3>
            </div>
            
            <div class="space-y-5">
                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" /></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-600">Pemasukan</span>
                    </div>
                    <span class="font-bold text-emerald-600">Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-red-50 text-red-500 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18" /></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-600">Pengeluaran</span>
                    </div>
                    <span class="font-bold text-red-500">Rp {{ number_format($pengeluaranBulanIni, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between items-center pb-3 border-b border-slate-100">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-amber-50 text-amber-500 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        </div>
                        <span class="text-sm font-medium text-slate-600">Tagihan Terbit (Belum Lunas)</span>
                    </div>
                    <span class="font-bold text-amber-600">Rp {{ number_format($bulanIniBelumBayar, 0, ',', '.') }}</span>
                </div>

                <div class="flex justify-between items-center bg-orange-50 rounded-xl p-3">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center mr-3">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
                        </div>
                        <span class="text-sm font-semibold text-orange-700">Subsidi Sosial Tersalur</span>
                    </div>
                    <span class="font-bold text-orange-600">Rp {{ number_format($subsidiSosial, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Chart (2 columns wide) -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 lg:col-span-2">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mr-3">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800">Grafik Keuangan Bulanan</h3>
                </div>
                <div class="flex items-center text-sm text-slate-500 border border-slate-200 rounded-lg px-3 py-1">
                    6 Bulan Terakhir <svg class="w-3 h-3 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                </div>
            </div>
            
            <div class="w-full" style="height: 250px;">
                <canvas id="financeChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Actions -->
        <div class="lg:col-span-2">
            <h3 class="text-lg font-bold text-slate-800 mb-4">Aksi Cepat</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.meter.create') }}" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition hover:border-blue-200 group">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mb-3 group-hover:bg-blue-600 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a1.5 1.5 0 01-1.5 1.5H6.937c-1.28 0-2.368.96-2.544 2.228C4.167 11.238 4 12.593 4 14c0 4.418 3.582 8 8 8s8-3.582 8-8c0-1.407-.167-2.762-.393-4.045-.176-1.268-1.264-2.228-2.544-2.228H15.75a1.5 1.5 0 01-1.5-1.5v0z" /></svg>
                    </div>
                    <h4 class="font-bold text-slate-700 text-sm mb-1">Catat Meter</h4>
                    <p class="text-[11px] text-slate-500">Input meter baru</p>
                </a>
                <a href="{{ route('admin.keuangan.setoran') }}" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition hover:border-emerald-200 group">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mb-3 group-hover:bg-emerald-600 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h4 class="font-bold text-slate-700 text-sm mb-1">Validasi Setoran</h4>
                    <p class="text-[11px] text-slate-500">Validasi pembayaran</p>
                </a>
                <a href="{{ route('admin.pelanggan.index') }}" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition hover:border-purple-200 group">
                    <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center mb-3 group-hover:bg-purple-600 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <h4 class="font-bold text-slate-700 text-sm mb-1">Kelola Pelanggan</h4>
                    <p class="text-[11px] text-slate-500">Tambah / ubah data</p>
                </a>
                <a href="{{ route('admin.penagihan.index') }}" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition hover:border-orange-200 group">
                    <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-600 flex items-center justify-center mb-3 group-hover:bg-orange-600 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                    </div>
                    <h4 class="font-bold text-slate-700 text-sm mb-1">Penagihan</h4>
                    <p class="text-[11px] text-slate-500">Buat tagihan baru</p>
                </a>
            </div>
        </div>

        <!-- System Info -->
        <div>
            <h3 class="text-lg font-bold text-slate-800 mb-4 opacity-0">Informasi Sistem</h3> <!-- Placeholder for alignment -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 text-slate-500 flex items-center justify-center mr-3">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" /></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-700">Informasi Sistem</h3>
                </div>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between pb-2 border-b border-slate-50">
                        <span class="text-slate-500 flex items-center"><svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>Versi Aplikasi</span>
                        <span class="font-medium text-slate-700">v2.3.0</span>
                    </div>
                    <div class="flex justify-between pb-2 border-b border-slate-50">
                        <span class="text-slate-500 flex items-center"><svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>Status Database</span>
                        <span class="font-medium text-emerald-500">Online</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-slate-500 flex items-center"><svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>Terakhir Update</span>
                        <span class="font-medium text-slate-700">{{ date('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
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
                            backgroundColor: '#10B981', // emerald-500
                            borderRadius: 4,
                            barPercentage: 0.6,
                        },
                        {
                            label: 'Pengeluaran (Rp)',
                            data: @json($chartPengeluaran),
                            backgroundColor: '#EF4444', // red-500
                            borderRadius: 4,
                            barPercentage: 0.6,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                            align: 'start',
                            labels: {
                                boxWidth: 10,
                                usePointStyle: true,
                                padding: 20
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#f1f5f9',
                                drawBorder: false,
                            },
                            border: { display: false }
                        },
                        x: {
                            grid: {
                                display: false,
                                drawBorder: false,
                            },
                            border: { display: false }
                        }
                    }
                }
            });
        });
    </script>
</div>
