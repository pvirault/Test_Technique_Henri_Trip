<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService
{
     /**
     * Get all users.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllUsers()
    {
        return User::all();
    }

     /**
     * Get a specific user by its ID.
     *
     * @param int $id
     * @return User
     */
    public function getUserById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Create a new user.
     *
     * @param array $data
     * @return User
     */
    public function createUser($data)
    {
        return User::create($data);
    }

    /**
     * Update an existing user by ID.
     *
     * @param int $id
     * @param array $data
     * @return User
     */
    public function updateUser($id, $data)
    {
        $user = User::findOrFail($id);
        $user->update($data);
        return $user;
    }

    /**
     * Delete a user by ID.
     *
     * @param int $id
     */
    public function deleteUser($id)
    {
        User::destroy($id);
    }
}
