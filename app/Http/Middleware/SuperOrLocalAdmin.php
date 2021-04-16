<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Auth\User;

class SuperOrLocalAdmin
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
        $user = User::where('user_id', session('user_id'))->first();
        // dd($user);
        if ($user->distributor_level === 1 || $user->manager_level === 1 ) {
            return $next($request);

        }
        return back();

    }
}
