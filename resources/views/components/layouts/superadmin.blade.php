<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Super Admin Dashboard - BILLPAM' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-[#F8F9FE] font-sans text-slate-900 antialiased flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-[280px] bg-white flex flex-col hidden md:flex h-full shadow-[2px_0_15px_rgba(0,0,0,0.03)] border-r border-slate-100 relative z-20">
        <!-- Logo Area -->
        <div class="h-32 flex flex-col items-center justify-center border-b border-slate-100 relative">
            <img src="{{ asset('logo_billpam.png') }}" alt="BILLPAM Logo" class="h-20 w-auto object-contain">
            <span class="absolute bottom-2 bg-amber-100 text-amber-700 border border-amber-200 text-[10px] font-bold px-2 py-0.5 rounded shadow-sm uppercase tracking-wider">Super Admin</span>
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="{{ route('superadmin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('superadmin.dashboard') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('superadmin.dashboard') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                Dashboard
            </a>
            
            <a href="{{ route('superadmin.tenant.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('superadmin.tenant.*') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('superadmin.tenant.*') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" /></svg>
                Manajemen Tenant
            </a>

            <a href="{{ route('superadmin.package.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('superadmin.package.*') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('superadmin.package.*') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5l-9-5.25L3 7.5m18 0l-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9" /></svg>
                Paket & Billing
            </a>
        </nav>
        
        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-slate-100 bg-white">
            <div class="flex items-center px-4 py-3 mb-2 rounded-xl border border-slate-100 bg-slate-50 shadow-sm relative overflow-hidden group">
                <div class="absolute inset-0 bg-blue-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center mr-3 font-bold shadow-sm">
                    {{ substr(Auth::user()->name ?? 'S', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-slate-800 text-sm truncate">{{ Auth::user()->name ?? 'Super Admin' }}</p>
                    <div class="flex items-center mt-0.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 mr-1.5"></span>
                        <p class="text-[10px] font-medium text-slate-500 truncate">{{ Auth::user()->role ?? 'Role' }}</p>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mt-2">
                @csrf
                <button type="submit" class="flex w-full items-center justify-center px-4 py-2.5 text-sm font-semibold text-red-600 bg-red-50 hover:bg-red-100 rounded-xl transition">
                    <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" /></svg>
                    Logout Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden bg-[#F8F9FE]">
        <!-- Header Mobile / Topbar -->
        <header class="bg-white/80 backdrop-blur-md h-16 flex items-center justify-between px-6 border-b border-slate-200 z-10 sticky top-0">
            <div class="md:hidden flex items-center">
                <button class="p-2 -ml-2 mr-2 text-slate-500 hover:text-slate-800 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <img src="{{ asset('logo_billpam.png') }}" alt="BILLPAM Logo" class="h-8 w-auto">
            </div>
            
            <div class="hidden md:flex items-center space-x-3">
                <div class="p-2 bg-white rounded-xl shadow-sm border border-slate-100">
                    <svg class="w-5 h-5 text-amber-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.827A10.12 10.12 0 0021 6.5C21 3.462 18.538 1 15.5 1S10 3.462 10 6.5a10.122 10.122 0 002.328 6.474l-4.135 4.103-1.636-1.621A2.652 2.652 0 002.8 19.206l2.122 2.102c.677.671 1.83.671 2.508 0l4.02-3.985-.03-.033z" /></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800 leading-tight">{{ $header ?? 'Super Admin Panel' }}</h2>
                    <p class="text-xs text-slate-500 font-medium">Selamat datang kembali, Owner! 👋</p>
                </div>
            </div>

            <div class="flex items-center space-x-4">
                <!-- Notifications (Mock) -->
                <button class="relative p-2 text-slate-500 hover:text-slate-800 transition rounded-full hover:bg-slate-100">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" /></svg>
                    <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
                    </span>
                </button>
            </div>
        </header>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-auto p-4 md:p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
