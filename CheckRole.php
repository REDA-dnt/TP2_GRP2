<?php


namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        if (!in_array(auth()->user()->role, $roles)) {
            return response()->json([
                'message' => 'Accès interdit'
            ], 403);
        }

        return $next($request);
    }
}
