<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard - BILLPAM' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-slate-900 text-white flex flex-col hidden md:flex h-full shadow-lg">
        <div class="h-16 flex items-center px-6 border-b border-slate-800">
            <span class="text-xl font-bold tracking-tight text-blue-400">BILLPAM</span>
            <span class="ml-2 text-xs font-medium text-slate-400 bg-slate-800 py-1 px-2 rounded">Tenant</span>
        </div>
        <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium hover:bg-blue-600 hover:text-white transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-700 text-white' : 'text-slate-300 hover:bg-slate-800' }}">
                Dashboard
            </a>
            <a href="{{ route('admin.pelanggan.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.pelanggan.index') ? 'bg-blue-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                Data Pelanggan
            </a>
            <a href="{{ route('admin.tarif.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.tarif.index') ? 'bg-blue-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                Tarif Air
            </a>
            <a href="{{ route('admin.meter.create') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.meter.create') ? 'bg-blue-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                Catat Meter
            </a>
            <a href="{{ route('admin.penagihan.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.penagihan.*') ? 'bg-blue-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                Penagihan
            </a>
            <a href="{{ route('admin.keuangan.setoran') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.keuangan.setoran') ? 'bg-blue-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                Validasi Setoran
            </a>
            <a href="{{ route('admin.keuangan.kas.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.keuangan.kas.*') ? 'bg-blue-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                Buku Kas Umum
            </a>
        </nav>
        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center text-sm mb-4 px-2">
                <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center mr-3">
                    <span class="font-bold">{{ substr(Auth::user()->name ?? 'A', 0, 1) }}</span>
                </div>
                <div class="flex-1 truncate">
                    <p class="font-medium truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ Auth::user()->role ?? 'Role' }}</p>
                </div>
            </div>

            <h4 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2 px-2 mt-4">Pengaturan</h4>
            
            @if(Auth::user()->role === 'admin_tenant')
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.users.*') ? 'bg-blue-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}">
                    Manajemen Akun
                </a>
                <a href="{{ route('admin.settings.tenant') }}" class="flex items-center px-4 py-2.5 rounded-lg text-sm font-medium transition {{ request()->routeIs('admin.settings.tenant') ? 'bg-blue-700 text-white' : 'text-slate-300 hover:bg-slate-800 hover:text-white mt-1' }}">
                    Profil Tenant
                </a>
            @endif

            <form method="POST" action="{{ route('logout') }}" class="mt-4 border-t border-slate-700 pt-4">
                @csrf
                <button type="submit" class="flex w-full items-center px-4 py-2 text-sm font-medium text-red-400 hover:text-red-300 hover:bg-slate-800 rounded-lg transition">
                    Logout Akun
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        <!-- Header Mobile / Topbar -->
        <header class="bg-white shadow-sm h-16 flex items-center justify-between px-6 border-b border-slate-200 z-10">
            <div class="md:hidden">
                <span class="text-xl font-bold text-blue-700">BILLPAM</span>
            </div>
            <div class="hidden md:block">
                <h2 class="text-lg font-semibold text-slate-800">{{ $header ?? '' }}</h2>
            </div>
            <div class="flex items-center">
                <!-- Tenant Indicator -->
                <span class="text-xs font-medium bg-blue-100 text-blue-800 py-1 px-3 rounded-full border border-blue-200">
                    Tenant ID: {{ \App\Services\TenantManager::getTenantId() ?? 'All' }}
                </span>
            </div>
        </header>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-auto p-6 bg-slate-50">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
