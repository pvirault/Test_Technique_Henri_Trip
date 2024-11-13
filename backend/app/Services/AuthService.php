<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthService
{
    // Method for authenticating the user
    public function login($email, $password)
    {
        // Find the user by email
        $user = User::where('email', $email)->first();

        // Check if the password is correct
        if ($user && Hash::check($password, $user->password)) {
            // Create and return the authentication token
            $token = $user->createToken('AuthToken')->plainTextToken;
            return ['token' => $token];
        }

        // Return error if email or password is invalid
        return ['error' => 'Invalid email or password'];
    }

    // Method for registering a new user
    public function register(array $data): array
    {
        // Validate user data
        $validated = $this->validateUserData($data);

        // Create the user in the database
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'email_verified_at' => null, // Email is not verified at the time of registration
        ]);

        // Generate an API key for the user
        $user->api_key = Str::random(60);
        $user->save();

        // Return a success message with user info
        return [
            'message' => 'Registration successful',
            'user' => $user,
            'api_key' => $user->api_key,
        ];
    }

    // Function to validate user data
    protected function validateUserData(array $data): array
    {
        return validator($data, [
            'name' => 'required|string',  // Name is required and should be a string
            'email' => 'required|email|unique:users,email', // Email is required, valid, and unique
            'password' => 'required|string|min:8', // Password is required, a string, and at least 8 characters
            'role' => 'required|in:user,admin', // Role is required, must be either 'user' or 'admin'
        ])->validate();
    }
}