<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BlockedStaff
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
        dd('blocked');
        if (auth()->check() && auth()->user()->block === false) {
            return $next($request);
        }

        return abort(403, 'Ваш профиль заблокирован');
    }
}
