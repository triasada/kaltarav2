<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user)
        {
            if($user->isApproved())
            {
                return $next($request);
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
