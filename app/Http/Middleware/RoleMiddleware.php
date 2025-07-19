<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth Facade
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Jika pengguna belum login, arahkan ke halaman login
        if (!Auth::check()) {
            return redirect('/login'); // Atau route('login')
        }

        // Jika pengguna login, periksa rolenya
        // Jika role pengguna tidak cocok dengan role yang diharapkan, arahkan ke halaman error atau beranda
        if (Auth::user()->role !== $role) {
            // Opsional: Anda bisa arahkan ke halaman 403 Forbidden
            // abort(403, 'Akses Ditolak. Anda tidak memiliki izin untuk mengakses halaman ini.');
            // Atau redirect ke beranda dengan pesan error
            return redirect('/')->with('error', 'Akses Ditolak. Anda tidak memiliki izin yang cukup.');
        }

        return $next($request);
    }
}
