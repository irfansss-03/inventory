<?php

namespace App;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  array<int, string>  $roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        if (! $user || (count($roles) && ! in_array($user->role, $roles))) {
            abort(Response::HTTP_FORBIDDEN);
        }

        return $next($request);
    }
}
