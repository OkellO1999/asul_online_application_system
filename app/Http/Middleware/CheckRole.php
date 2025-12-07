<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next)

    {
         $route = $request->route();
         $actions = $route->getAction();
            $prefix = $request->route()->getPrefix();
        // Check if user is authenticated
           if (!Auth::check()) {
        return redirect('/login');
    }

    $user = Auth::user();

    // Check the prefix
    if ($prefix == 'admin' && !$user->isAdmin()) {
        abort(403, 'Unauthorized action. Admin access required.');
    }

    if ($prefix == 'registrar' && !$user->isRegistrar()) {
        abort(403, 'Unauthorized action. Registrar access required.');
    }

    if ($prefix == 'applicant' && !$user->isApplicant()) {
        abort(403, 'Unauthorized action. Applicant access required.');
    }

    return $next($request);
    }
}
