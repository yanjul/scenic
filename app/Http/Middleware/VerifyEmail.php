<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class VerifyEmail
{

    public function handle($request, Closure $next, $guards = null)
    {
        if (!Auth::user()->status) {
            return redirect()->back();
        }

        return $next($request);

    }
}