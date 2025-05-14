<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdminLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$allowedLevels)
    {
        // Pastikan user terautentikasi
        if (Auth::guard('admin')->check()) {
            $userLevel = Auth::guard('admin')->user()->level->nama_level;

            // Periksa apakah level user termasuk dalam daftar yang diizinkan
            if (in_array($userLevel, $allowedLevels)) {
                return $next($request);
            }
        }

        // Redirect jika tidak memiliki akses
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
    }
}
