<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class VerifyMobile
{

    public function handle($request, Closure $next, $guards = null)
    {
        if (!Auth::user()->telephone) {
            return redirect('user/bind-mobile');
        }

        return $next($request);

    }
}