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
        $setting = Setting::where('key', 'maintenance_mode')->first();
        $isMaintenance = $setting && $setting->value === 'true';

        if (!$isMaintenance) {
            return $next($request);
        }

        if (Auth::check() && Auth::user()->role !== 'superadmin') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if (
            $request->routeIs('login') ||
            $request->is('login') ||
            $request->routeIs('register') ||
            $request->is('register') ||
            $request->routeIs('logout') ||
            $request->is('logout') ||
            $request->is('livewire/*') ||
            $request->is('flux/*') ||
            $request->is('auth/google*')
        ) {
            return $next($request);
        }

        if (Auth::check() && Auth::user()->role === 'superadmin') {
            return $next($request);
        }

        return response()->view('errors.maintenance', [], Response::HTTP_SERVICE_UNAVAILABLE); // Menggunakan konstanta 503
    }
}
