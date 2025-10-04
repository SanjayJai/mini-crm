<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // ✅ Allow access if user’s role matches any of the allowed roles
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // ✅ If the user is admin, allow full access
        if ($user->role === 'admin') {
            return $next($request);
        }

        // 🚫 Otherwise, block access
        abort(403, 'Unauthorized');
    }
}
