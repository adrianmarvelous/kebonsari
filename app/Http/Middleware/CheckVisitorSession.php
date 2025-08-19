<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckVisitorSession
{
    public function handle(Request $request, Closure $next)
    {
        // Jika route ini adalah index, biarkan lewat walau session belum ada
        if ($request->routeIs('web.layanan.index')) {
            return $next($request);
        }

        // Jika session visitor tidak ada, redirect ke index
        if (!session()->has('visitor_nama')) {
            return redirect()->route('web.layanan.index')
                ->with('error', 'Silakan masuk sebagai visitor dulu.');
        }

        return $next($request);
    }
}
