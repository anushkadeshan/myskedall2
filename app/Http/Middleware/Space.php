<?php

namespace App\Http\Middleware;

use Closure;
use DB;
class Space
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
		$user = DB::table('users')->where(['id'=>session('user_id')])->first();
        $request->user=$user;
		return $next($request);
    }
}
