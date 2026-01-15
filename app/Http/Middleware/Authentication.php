<?php

namespace App\Http\Middleware;

use App\Services\Admin\AuthenticationService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Middleware untuk mengecek apakah user sudah login
class Authentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Inject AuthenticationService
        $authService = app(AuthenticationService::class);

        // Check apakah user sudah login
        if (!$authService->isAuthenticated()) {
            // Jika belum login, redirect ke login page
            return redirect()->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        // Jika sudah login, lanjut ke next request
        return $next($request);
    }
}
