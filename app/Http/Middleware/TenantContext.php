<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Services\TenantManager;

class TenantContext
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $user = Auth::user();
            
            // Bypass tenant scope for super admin
            if ($user->role === 'super_admin') {
                TenantManager::setTenantId(null);
            } else {
                TenantManager::setTenantId($user->tenant_id);
            }
        }

        return $next($request);
    }
}
