<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class ModuleAdmin
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

        if ($user->secretary_level == 0) {
            return back();
        }
        return $next($request);
    }
}
