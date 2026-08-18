<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login - HIPPAMS' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased flex min-h-screen items-center justify-center p-4">
    <div class="w-full max-w-md">
        <!-- Logo Area -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-blue-700 tracking-tight">HIPPAMS</h1>
            <p class="text-sm text-slate-500 mt-2">Sistem Manajemen HIPPAM & PAMSIMAS</p>
        </div>

        <!-- Main Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            {{ $slot }}
        </div>
        
        <div class="text-center mt-6">
            <p class="text-xs text-slate-400">&copy; {{ date('Y') }} HIPPAMS. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
