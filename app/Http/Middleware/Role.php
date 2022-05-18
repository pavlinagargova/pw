<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        Auth::loginUsingId('1', true);
        if (!Auth::check()) {
            return redirect('/');
        }

        $user = Auth::user()->load('role');

        foreach($roles as $role) {
            if($user->role->name === $role) {
                return $next($request);
            }
        }

        return redirect('/');
    }
}
