<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;  // Inject the UserService for business logic
    }

    /**
     * Show a list of users.
     */
    public function index()
    {
        $users = $this->userService->getAllUsers();
        return response()->json($users);
    }

    /**
     * Show a specific user by ID.
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);
        return response()->json($user);
    }

    /**
     * Create a new user.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:user,admin',
        ]);

        $user = $this->userService->createUser($validated);
        return response()->json($user, 201);
    }

    /**
     * Update a user by ID.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'nullable|string',
            'email' => 'nullable|email',
            'password' => 'nullable|string|min:8',
            'role' => 'nullable|in:user,admin',
        ]);

        $user = $this->userService->updateUser($id, $validated);
        return response()->json($user);
    }

    /**
     * Delete a user by ID.
     */
    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return response()->json(['message' => 'User deleted successfully']);
    }
}
