<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        $user = $request->user();

        if (!$user || ($role === 'admin' && $user->email !== 'emin@admin.com')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}