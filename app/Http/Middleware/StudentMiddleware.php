<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // dd('Middleware executed');
        if (!Auth::guard('student')->check()) {
            return redirect()->route('student.login')->with('error','Unautorized user!'); 
        }

        return $next($request);
    }
}
