<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AcceptTermsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Check if the user has accepted the terms
        if (Auth::check() && !Auth::user()->accepted_terms) {
            return redirect()->route('terms'); // Redirect to the terms page if not accepted
        }

        return $next($request);
    }
}
