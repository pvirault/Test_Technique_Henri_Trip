<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected $authService;

    /**
     * Initialize AuthService instance
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Log in user and return auth token on success
     */
    public function login(Request $request)
    {
          $response = $this->authService->login($request->email, $request->password);

          if (isset($response['error'])) {
              return response()->json($response, 403);
          }
  
          return response()->json($response);
    }

    /**
     * Register a new user and return auth data on success
     */
    public function register(Request $request)
    {
        try {
            $result = $this->authService->register($request->all());
            return response()->json($result, 201);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    /**
     * Log out the user by deleting the current access token
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}
