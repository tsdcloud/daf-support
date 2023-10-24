<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Entity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(session()->has('fonction_id')){
            // dd(session('fonction_id'));
            // dd(2);
            return $next($request);
        }
        abort(403);
    }
}
