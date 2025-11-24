<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        // Kalau belum login, kirim ke halaman login
        if (! $user) {
            return redirect()->route('login');
        }

        // Cek role di kolom "role" (admin / customer)
        if ($user->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman admin.');
        }

        return $next($request);
    }
}
