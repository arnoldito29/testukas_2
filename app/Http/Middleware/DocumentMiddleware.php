<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DocumentMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $routeName = $request->route()->parameter('type');
        $allow = collect(['shipment', 'reservation']);

        if (!$allow->contains($routeName)) {
            abort(403, 'Forbidden');
        }

        return $next($request);
    }
}
