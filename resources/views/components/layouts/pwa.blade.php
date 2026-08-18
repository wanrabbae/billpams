<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>{{ $title ?? 'BILLPAMS Mobile' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Hide scrollbar for PWA feel */
        ::-webkit-scrollbar { display: none; }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased flex flex-col h-screen overflow-hidden">

    <!-- Top Bar -->
    <header class="bg-blue-700 text-white flex items-center justify-between px-4 h-14 shadow-md z-10 shrink-0">
        <div class="font-semibold text-lg flex items-center">
            <img src="{{ asset('logo_billpam.png') }}" alt="Logo" class="h-6 w-auto mr-2 brightness-0 invert">
            {{ $header ?? 'BILLPAMS' }}
        </div>
        <div>
            <!-- Logout Icon -->
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="p-2 -mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                </button>
            </form>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto p-4 pb-24">
        {{ $slot }}
    </main>

    <!-- Bottom Navigation Bar -->
    <nav class="bg-white border-t border-slate-200 fixed bottom-0 w-full h-16 flex justify-around items-center px-2 z-20 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.05)] pb-safe">
        <!-- Beranda -->
        <a href="{{ route('pwa.dashboard') ?? '#' }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('pwa.dashboard') ? 'text-blue-700' : 'text-slate-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('pwa.dashboard') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="text-[10px] font-medium">Beranda</span>
        </a>

        <!-- Catat Meter -->
        <a href="{{ route('pwa.meter.create') ?? '#' }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('pwa.meter.create') ? 'text-blue-700' : 'text-slate-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('pwa.meter.create') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 016 3.75h2.25A2.25 2.25 0 0110.5 6v2.25a2.25 2.25 0 01-2.25 2.25H6a2.25 2.25 0 01-2.25-2.25V6zM3.75 15.75A2.25 2.25 0 016 13.5h2.25a2.25 2.25 0 012.25 2.25V18a2.25 2.25 0 01-2.25 2.25H6A2.25 2.25 0 013.75 18v-2.25zM13.5 6a2.25 2.25 0 012.25-2.25H18A2.25 2.25 0 0120.25 6v2.25A2.25 2.25 0 0118 10.5h-2.25a2.25 2.25 0 01-2.25-2.25V6zM13.5 15.75a2.25 2.25 0 012.25-2.25H18a2.25 2.25 0 012.25 2.25V18A2.25 2.25 0 0118 20.25h-2.25A2.25 2.25 0 0113.5 18v-2.25z" />
            </svg>
            <span class="text-[10px] font-medium">Catat</span>
        </a>

        <!-- Bayar -->
        <a href="{{ route('pwa.kasir.bayar') }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 text-slate-400 relative">
            <div class="absolute -top-5 bg-blue-700 text-white rounded-full p-3 shadow-lg border-4 border-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
            <span class="text-[10px] font-medium mt-6">Bayar</span>
        </a>

        <!-- Pelanggan -->
        <a href="{{ route('pwa.pelanggan.index') ?? '#' }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('pwa.pelanggan.index') ? 'text-blue-700' : 'text-slate-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="{{ request()->routeIs('pwa.pelanggan.index') ? 'currentColor' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
            </svg>
            <span class="text-[10px] font-medium">Warga</span>
        </a>

        <!-- Akun/Setoran -->
        <a href="{{ route('pwa.setoran.index') }}" class="flex flex-col items-center justify-center w-full h-full space-y-1 {{ request()->routeIs('pwa.setoran.index') ? 'text-blue-700' : 'text-slate-400' }}">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="text-[10px] font-medium">Setoran</span>
        </a>
    </nav>
</body>
</html>
