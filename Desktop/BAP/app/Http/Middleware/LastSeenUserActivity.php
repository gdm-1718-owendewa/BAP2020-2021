<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Auth;
use Cache;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LastSeenUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request);
    }
}
