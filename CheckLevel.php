<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $level)
    {
        $levels = [
            'admin' => ['admin'],
            'staff' => ['admin', 'staff'],
            'public' => ['public']
        ];

        if (!in_array(auth()->user()->level, $levels[$level])) {
            return abort(403);
        }

        return $next($request);
    }
}