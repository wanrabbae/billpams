<div>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-blue-100 p-6 flex flex-col items-center text-center">
            <span class="text-sm font-semibold text-blue-600 mb-1">TOTAL TENANT</span>
            <span class="text-4xl font-bold text-slate-800">{{ $totalTenants }}</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-green-100 p-6 flex flex-col items-center text-center">
            <span class="text-sm font-semibold text-green-600 mb-1">TENANT AKTIF</span>
            <span class="text-4xl font-bold text-slate-800">{{ $activeTenants }}</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-red-100 p-6 flex flex-col items-center text-center">
            <span class="text-sm font-semibold text-red-500 mb-1">TENANT SUSPEND</span>
            <span class="text-4xl font-bold text-slate-800">{{ $suspendedTenants }}</span>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-indigo-100 p-6 flex flex-col items-center text-center">
            <span class="text-sm font-semibold text-indigo-600 mb-1">TOTAL END-USERS</span>
            <span class="text-4xl font-bold text-slate-800">{{ $totalPelanggan }}</span>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-3xl">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Selamat Datang, Super Admin (Faisal Group)</h3>
        <p class="text-slate-600 mb-4">
            Ini adalah pusat kendali utama untuk platform BILLPAMS SaaS. Dari sini, Anda mengendalikan seluruh sistem. 
            Data yang disajikan di level ini melintasi batas (cross-tenant), sehingga Anda dapat memantau skala dari seluruh organisasi pengguna.
        </p>
        <div class="flex flex-wrap gap-4 mt-6">
            <a href="{{ route('superadmin.tenant.index') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 px-6 rounded-lg transition shadow-sm text-sm">Kelola Tenant HIPPAM</a>
            <a href="{{ route('superadmin.package.index') }}" class="bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-medium py-2 px-6 rounded-lg transition shadow-sm text-sm">Lihat Paket Harga</a>
        </div>
    </div>
</div>
