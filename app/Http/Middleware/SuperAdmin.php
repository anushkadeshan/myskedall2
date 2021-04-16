<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class SuperAdmin
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
        //dd(session('user_id'));
        $user = User::where('user_id',session('user_id'))->first();
       // dd($user);
        if ($user->distributor_level == 0) {
            return back();
        }
        return $next($request);
    }
}
