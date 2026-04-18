<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsEmployer
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->user() || !$request->user()->isEmployer()) {
            abort(403, 'Access denied. Employer account required.');
        }

        return $next($request);
    }
}
