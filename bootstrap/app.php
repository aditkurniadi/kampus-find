<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        channels: __DIR__ . '/../routes/channels.php',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // ... (kode middleware Anda mungkin ada di sini)
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // 2. GANTI KODE DEBUG dd() ANDA DENGAN INI
        $exceptions->renderable(function (AccessDeniedHttpException $e, $request) {
            // (Kita ganti 'AuthorizationException' di atas menjadi 'AccessDeniedHttpException')

            return redirect()->back()->with('toast', [
                'type' => 'error',
                'message' => 'Anda tidak memiliki izin untuk mengakses halaman tersebut.'
            ]);
        });
        // --- AKHIR BLOK ---

    })->create();
