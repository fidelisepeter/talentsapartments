<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class loginAuth
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
        $isAuthenticatedAdmin = (Auth::check());

        //This will be excecuted if the new authentication fails.
        if (!$isAuthenticatedAdmin){

            return redirect()->route('login')->with('message', 'Authentication Error.');
        }
        return $next($request);

    }
}
