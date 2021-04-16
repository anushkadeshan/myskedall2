<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAppPermission
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
        $app_id = $request->route()->parameter('id');
        $user = Auth::user()->apps()->where('app_id',$app_id)->exists();

        if (!$user) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }
}
