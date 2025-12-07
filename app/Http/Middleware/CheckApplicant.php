<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckApplicant
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isApplicant()) {
            return $next($request);
        }

        return redirect('/'); // or wherever you want to redirect non-applicants
    }
}
