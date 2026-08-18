<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login - BILLPAMS' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased flex min-h-screen items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo Area -->
        <div class="text-center mb-8 flex flex-col items-center">
            <img src="{{ asset('logo_billpam.png') }}" alt="BILLPAMS Logo" class="h-20 w-auto mb-3 object-contain drop-shadow-sm">
            <p class="text-sm text-slate-500">Sistem Manajemen HIPPAM & PAMSIMAS</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            {{ $slot }}
        </div>
        
        <div class="text-center mt-6">
            <p class="text-xs text-slate-400">&copy; {{ date('Y') }} BILLPAMS. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
