<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
    public function getAllUsers()
    {
        return User::all();
    }

    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    public function createUser($data)
    {
        return User::create($data);
    }

    public function updateUser($id, $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    public function deleteUser($id)
    {
        User::destroy($id);
    }

    public function adminLogin($email, $password)
    {
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            if ($user->role !== 'admin') {
                return ['error' => 'Access reserved for administrators.'];
            }

            $token = $user->createToken('API-AuthToken')->plainTextToken;
            return ['token' => $token];
        }

        return ['error' => 'Unauthorized'];
    }

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

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
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
