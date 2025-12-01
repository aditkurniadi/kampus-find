<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Ambil status dari Database
        // Gunakan 'first()' atau 'where' sesuai struktur tabel settings kamu
        // Asumsi: key='maintenance_mode' dan value='true'/'false'
        $setting = Setting::where('key', 'maintenance_mode')->first();
        $isMaintenance = $setting && $setting->value === 'true';

        // 2. Jika TIDAK maintenance, silakan lewat
        if (!$isMaintenance) {
            return $next($request);
        }

        // --- LOGIKA PENGECUALIAN (WHITELIST) ---

        // A. Izinkan akses ke Login, Logout, dan aset internal Livewire
        // (Penting agar halaman login tidak ikut terblokir)
        if (
            $request->routeIs('login') ||
            $request->routeIs('logout') ||
            $request->is('livewire/*') ||
            $request->is('flux/*') ||
            $request->is('auth/google*')
        ) { // Tambahan jika pakai Flux assets
            return $next($request);
        }

        // B. Jika User SUDAH Login DAN dia Superadmin, boleh lewat
        if (Auth::check() && Auth::user()->role === 'superadmin') {
            return $next($request);
        }

        // 3. Jika bukan siapa-siapa, TAMPILKAN HALAMAN MAINTENANCE
        return response()->view('errors.maintenance', [], 503);
    }
}
