<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = Auth::user();
        if($user)
        {
            if($user->isApproved())
            {
                return redirect('dashboard');
            }
            else
            {
                Auth::logout();
                return redirect()->route('login')->withError('Akun anda belum di verifikasi');
            }
        }
        else
        {
            return $next($request);
        }
    }
}
