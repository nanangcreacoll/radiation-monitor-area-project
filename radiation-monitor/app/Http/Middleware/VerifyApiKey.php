<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifyApiKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $receivedKey = $request->header('Api-Key');
        $validKey = config('app.api_key');

        if ($receivedKey !== $validKey) {
            return response()->json(['error' => 'invalid_key', 'message' => 'Invalid key'], 401);
        }
        return $next($request);
    }
}
