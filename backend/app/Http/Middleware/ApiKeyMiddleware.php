<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class ApiKeyMiddleware
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
        // Retrieve API key from Authorization header
        $apiKey = $request->header('Authorization');

        // Check if API key is present
        if (!$apiKey) {
            return response()->json(['error' => 'API Key is missing'], 401);
        }

        // Attempt to find a user with the provided API key
        $user = User::where('api_key', $apiKey)->first();

        // Return unauthorized if no matching user found
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Allow request to proceed if API key is valid
        return $next($request);
    }
}
