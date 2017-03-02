<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class VerifyUser
{

    public function handle($request, Closure $next, $guards = null)
    {
        if ($guards == 'mobile') {
            if (!Auth::user()->telephone) {
                return redirect('user/bind-mobile');
            }
        } else if ($guards == 'email') {
            if (!Auth::user()->status) {
                return redirect()->back();
            }
        } else if ($guards == 'business') {
            if (!Auth::user()->role) {
                return redirect()->back();
            }
        }
        return $next($request);
    }
}