<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @param null $role
     * @return \Illuminate\Http\RedirectResponse|mixed
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        // If middleware role is null user has to has a role that is not 'user'
        // Used for the admin.php routes
        if(is_null($role) && Auth::user()->role != User::ROLE_USER) {
            return $next($request);
        }

        if($role && Auth::user()->role == $role) {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
