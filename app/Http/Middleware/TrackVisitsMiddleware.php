<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visit; // Model untuk kunjungan
use Carbon\Carbon; // Untuk tanggal dan waktu

class TrackVisitsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jangan melacak kunjungan jika request-nya ke aset statis atau dasbor admin
        if ($request->is('admin/*') || $request->isMethod('POST')) {
            return $next($request);
        }

        // Ambil IP address pengunjung
        $ip = $request->ip();

        // Cek apakah pengunjung ini (berdasarkan IP) sudah mengunjungi dalam 30 menit terakhir
        $lastVisit = Visit::where('ip_address', $ip)
            ->where('created_at', '>', Carbon::now()->subMinutes(30))
            ->first();

        // Jika tidak ada kunjungan dalam 30 menit terakhir, catat kunjungan baru
        if (!$lastVisit) {
            Visit::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(), // Catat user agent juga
            ]);
        }

        return $next($request);
    }
}