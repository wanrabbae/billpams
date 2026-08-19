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
<body class="bg-[#F8F9FE] font-sans text-slate-900 antialiased flex h-screen overflow-hidden">
    
    <!-- Sidebar -->
    <aside class="w-[280px] bg-white flex flex-col hidden md:flex h-full shadow-[2px_0_15px_rgba(0,0,0,0.03)] border-r border-slate-100 relative z-20">
        <!-- Logo Area -->
        <div class="h-32 flex flex-col items-center justify-center border-b border-slate-100">
            <img src="{{ asset('logo_billpam.png') }}" alt="BILLPAM Logo" class="h-20 w-auto object-contain">
        </div>
        
        <!-- Navigation -->
        <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" /></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.pelanggan.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.pelanggan.index') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.pelanggan.index') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" /></svg>
                Data Pelanggan
            </a>
            <a href="{{ route('admin.tarif.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.tarif.index') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.tarif.index') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                Tarif Air
            </a>
            <a href="{{ route('admin.meter.create') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.meter.create') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.meter.create') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M14.25 6.087c0-.355.186-.676.401-.959.221-.29.349-.634.349-1.003 0-1.036-1.007-1.875-2.25-1.875s-2.25.84-2.25 1.875c0 .369.128.713.349 1.003.215.283.401.604.401.959v0a1.5 1.5 0 01-1.5 1.5H6.937c-1.28 0-2.368.96-2.544 2.228C4.167 11.238 4 12.593 4 14c0 4.418 3.582 8 8 8s8-3.582 8-8c0-1.407-.167-2.762-.393-4.045-.176-1.268-1.264-2.228-2.544-2.228H15.75a1.5 1.5 0 01-1.5-1.5v0z" /></svg>
                Catat Meter
            </a>
            <a href="{{ route('admin.penagihan.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.penagihan.*') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.penagihan.*') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" /></svg>
                Penagihan
            </a>
            <a href="{{ route('admin.keuangan.setoran') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.keuangan.setoran') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.keuangan.setoran') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" /></svg>
                Validasi Setoran
            </a>
            <a href="{{ route('admin.keuangan.kas.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.keuangan.kas.*') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.keuangan.kas.*') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" /></svg>
                Buku Kas Umum
            </a>

            @if(Auth::user()->role === 'admin_tenant')
                <div class="pt-4 pb-1">
                    <p class="px-4 text-xs font-semibold text-slate-400 uppercase tracking-wider">Pengaturan</p>
                </div>
                <a href="{{ route('admin.users.index') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.users.*') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                    Manajemen Akun
                </a>
                <a href="{{ route('admin.settings.tenant') }}" class="flex items-center px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs('admin.settings.tenant') ? 'bg-blue-600 text-white shadow-[0_4px_10px_rgba(37,99,235,0.2)]' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600' }}">
                    <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.settings.tenant') ? 'text-white' : 'text-slate-400' }}" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" /></svg>
                    Profil Tenant
                </a>
            @endif
        </nav>
        
        <!-- User Profile & Logout -->
        <div class="p-4 border-t border-slate-100 bg-white">
            <div class="flex items-center px-4 py-3 mb-2 rounded-xl border border-slate-100 bg-slate-50 shadow-sm relative overflow-hidden group">
                <div class="absolute inset-0 bg-blue-600 opacity-0 group-hover:opacity-10 transition-opacity"></div>
                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center mr-3 font-bold shadow-sm">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-bold text-slate-800 text-sm truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
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
                    Logout Akun
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
                    <svg class="w-5 h-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" /></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800 leading-tight">{{ $header ?? '' }}</h2>
                    <p class="text-xs text-slate-500 font-medium">Selamat datang kembali, {{ Auth::user()->name ?? 'Admin' }}! 👋</p>
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

                <!-- Tenant Indicator -->
                <div class="hidden sm:flex items-center pl-4 border-l border-slate-200">
                    <div class="bg-blue-50 text-blue-700 px-3 py-1.5 rounded-lg border border-blue-100 flex items-center font-semibold text-sm shadow-sm">
                        Tenant ID: {{ \App\Services\TenantManager::getTenantId() ?? 'All' }}
                        <svg class="w-4 h-4 ml-2 opacity-50" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" /></svg>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-auto p-4 md:p-6 lg:p-8">
            {{ $slot }}
        </main>
    </div>

</body>
</html>
