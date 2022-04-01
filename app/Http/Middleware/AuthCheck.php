<?php

namespace App\Http\Middleware;

use App\Exceptions\Handler;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        $user = User::where('token', $request->bearerToken())->first();
        if (!$user) {
            return Handler::raise403();
        }
        $request->user = $user;
        return $next($request);
    }
}
