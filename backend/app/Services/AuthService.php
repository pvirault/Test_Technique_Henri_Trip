<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class AuthService
{
    public function login($email, $password)
    {
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            $token = $user->createToken('AuthToken')->plainTextToken;
            return ['token' => $token];
        }

        return ['error' => 'Invalid email or password'];
    }

    public function register(array $data): array
    {
        $validated = $this->validateUserData($data);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'email_verified_at' => null,
        ]);

        $user->api_key = Str::random(60);
        $user->save();

        return [
            'message' => 'Registration successful',
            'user' => $user,
            'api_key' => $user->api_key,
        ];
    }

    protected function validateUserData(array $data): array
    {
        return validator($data, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ])->validate();
    }
}