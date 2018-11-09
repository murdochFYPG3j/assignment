<?php

namespace App\Http\Middleware;

use Closure;

class RolesAllowed
{
    public function handle($request, Closure $next, ...$roles)
    {
        if ( collect($roles)->contains( auth()->user()->role ) )
            return $next($request);
        else
            return abort(403, "You don't have permission to perform this action.");
    }
}
