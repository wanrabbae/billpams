<div>
    <!-- Stat Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between">
            <div class="flex items-start gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Total Tenant</p>
                    <h3 class="text-3xl font-black text-slate-800 leading-none">{{ $totalTenants }}</h3>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between text-xs font-medium">
                <span class="text-emerald-500 flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4.5 10.5L12 3m0 0l7.5 7.5M12 3v18" /></svg>
                    100%
                </span>
                <span class="text-slate-400">capacity</span>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between">
            <div class="flex items-start gap-4">
                <div class="p-3 bg-emerald-50 text-emerald-600 rounded-xl">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Tenant Aktif</p>
                    <h3 class="text-3xl font-black text-slate-800 leading-none">{{ $activeTenants }}</h3>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between text-xs font-medium">
                <span class="text-emerald-500 flex items-center">
                    Semua sistem berjalan
                </span>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between">
            <div class="flex items-start gap-4">
                <div class="p-3 bg-red-50 text-red-500 rounded-xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Tenant Suspend</p>
                    <h3 class="text-3xl font-black text-slate-800 leading-none">{{ $suspendedTenants }}</h3>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between text-xs font-medium">
                <span class="text-slate-400 flex items-center">
                    Akses ditutup
                </span>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5 flex flex-col justify-between">
            <div class="flex items-start gap-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-1">Total End-Users</p>
                    <h3 class="text-3xl font-black text-slate-800 leading-none">{{ $totalPelanggan }}</h3>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between text-xs font-medium">
                <span class="text-emerald-500 flex items-center">
                    Seluruh pengguna HIPPAM
                </span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Keuangan -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 lg:col-span-2">
            <div class="flex items-center mb-4">
                <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center mr-3">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="text-lg font-bold text-slate-800">Sistem Kendali SaaS (Faisal Group)</h3>
            </div>
            <p class="text-slate-500 mb-6 text-sm leading-relaxed">
                Ini adalah pusat kendali utama untuk platform BILLPAM SaaS. Dari sini, Anda mengendalikan seluruh sistem. 
                Data yang disajikan di level ini melintasi batas (cross-tenant), sehingga Anda dapat memantau skala dari seluruh organisasi pengguna.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a href="{{ route('superadmin.tenant.index') }}" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition hover:border-blue-200 group flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center mr-4 group-hover:bg-blue-600 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-700 text-sm mb-0.5">Kelola Tenant</h4>
                        <p class="text-[11px] text-slate-500">Tambah HIPPAM baru</p>
                    </div>
                </a>
                <a href="{{ route('superadmin.package.index') }}" class="bg-white p-4 rounded-2xl border border-slate-100 shadow-sm hover:shadow-md transition hover:border-emerald-200 group flex items-center">
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center mr-4 group-hover:bg-emerald-600 group-hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-slate-700 text-sm mb-0.5">Paket & Billing</h4>
                        <p class="text-[11px] text-slate-500">Sesuaikan paket SaaS</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- System Info -->
        <div>
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 h-full">
                <div class="flex items-center mb-4">
                    <div class="w-8 h-8 rounded-lg bg-slate-50 text-slate-500 flex items-center justify-center mr-3">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01" /></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-700">Informasi Server Core</h3>
                </div>
                <div class="space-y-4 text-sm mt-6">
                    <div class="flex justify-between pb-2 border-b border-slate-50">
                        <span class="text-slate-500 flex items-center"><svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>Versi Aplikasi</span>
                        <span class="font-bold text-slate-700">BILLPAM v2.3.0</span>
                    </div>
                    <div class="flex justify-between pb-2 border-b border-slate-50">
                        <span class="text-slate-500 flex items-center"><svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" /></svg>Status Database</span>
                        <span class="font-bold text-emerald-500">Online & Secured</span>
                    </div>
                    <div class="flex justify-between pb-2 border-b border-slate-50">
                        <span class="text-slate-500 flex items-center"><svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>Terakhir Update</span>
                        <span class="font-bold text-slate-700">{{ date('d M Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
