<div>
    <div class="bg-blue-700 text-white p-6 rounded-b-3xl -mx-4 -mt-4 shadow-md mb-6">
        <h2 class="text-2xl font-bold tracking-tight">Halo, {{ Auth::user()->name ?? 'Petugas' }}!</h2>
        <p class="text-blue-200 text-sm mt-1">Selamat bertugas hari ini.</p>
    </div>

    <h3 class="font-bold text-slate-800 mb-4 px-1">Menu Utama</h3>
    <div class="grid grid-cols-2 gap-4 mb-6">
        <!-- Catat Meter Menu -->
        <a href="{{ route('pwa.meter.create') ?? '#' }}" class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center active:scale-95 transition-transform">
            <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-3 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6z" />
                </svg>
            </div>
            <span class="font-bold text-slate-700 text-sm">Catat Meter</span>
        </a>

        <!-- Terima Pembayaran Menu -->
        <a href="{{ route('pwa.kasir.bayar') }}" class="bg-white p-4 rounded-2xl shadow-sm border border-slate-100 flex flex-col items-center justify-center text-center active:scale-95 transition-transform">
            <div class="w-14 h-14 bg-green-100 text-green-600 rounded-full flex items-center justify-center mb-3 shadow-inner">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-7 h-7">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75" />
                </svg>
            </div>
            <span class="font-bold text-slate-700 text-sm">Kasir Bayar</span>
        </a>
    </div>

    <!-- Ringkasan Singkat -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
        <h3 class="font-bold text-slate-800 mb-2">Tugas Bulan Ini</h3>
        <p class="text-sm text-slate-500">Anda dapat memantau progres pencatatan meter dan penerimaan setoran di menu laporan nantinya.</p>
    </div>
</div>
