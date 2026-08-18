<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        if (!in_array($user->role, $roles)) {
            // Jika role tidak sesuai, lemparkan kembali ke dashboard masing-masing
            return match ($user->role) {
                'super_admin' => redirect()->to('/super/dashboard'),
                'admin_tenant', 'bendahara', 'pengawas' => redirect()->to('/admin/dashboard'),
                'petugas' => redirect()->to('/pwa/dashboard'),
                default => abort(403, 'Akses tidak diizinkan.'),
            };
        }

        return $next($request);
    }
}
