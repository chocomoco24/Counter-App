<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check() || !auth()->user()->isStudent()) {
            return redirect('/login')->with('error', 'Student access only.');
        }
        return $next($request);
    }
    
}
