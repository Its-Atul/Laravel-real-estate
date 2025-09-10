<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check the user's status
            $user = Auth::user();

            if ($user->status !== 'active') {
                // User is inactive, you can customize the response or redirect
                return redirect()->route('inactive.account');
            }
        }

        // Continue to the next middleware or the requested route
        return $next($request);
    }
}
