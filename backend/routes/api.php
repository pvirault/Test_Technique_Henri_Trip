<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['api.key'])->group(function () {

    // User Routes
    Route::get('/users', [UserController::class, 'index']);            // GET /users - Fetch all users
    Route::get('/users/{id}', [UserController::class, 'show']);        // GET /users/{id} - Fetch a specific user by ID
    Route::put('/users/{id}', [UserController::class, 'update']);      // PUT /users/{id} - Update a user's information by ID
    Route::delete('/users/{id}', [UserController::class, 'destroy']);  // DELETE /users/{id} - Delete a user by ID
    
    // Guide Routes
    Route::get('/guides', [GuideController::class, 'index']);            // GET /guides - Fetch all guides
    Route::post('/guides', [GuideController::class, 'store']);           // POST /guides - Create a new guide
    Route::get('/guides/{id}', [GuideController::class, 'show']);        // GET /guides/{id} - Fetch a specific guide by ID
    Route::put('/guides/{id}', [GuideController::class, 'update']);      // PUT /guides/{id} - Update a guide by ID
    Route::delete('/guides/{id}', [GuideController::class, 'destroy']);  // DELETE /guides/{id} - Delete a guide by ID

    Route::get('/guides/search', [GuideController::class, 'search']);    // GET /guides/search - Search guides by given criteria
    
    // Activity Routes (Nested under Guide)
    Route::get('/guides/{guideId}/activities', [ActivityController::class, 'index']);                // GET /guides/{guideId}/activities - Fetch all activities for a specific guide
    Route::post('/guides/{guideId}/activities', [ActivityController::class, 'store']);               // POST /guides/{guideId}/activities - Create a new activity for a specific guide
    Route::get('/guides/{guideId}/activities/{activityId}', [ActivityController::class, 'show']);    // GET /guides/{guideId}/activities/{activityId} - Fetch a specific activity for a guide
    Route::put('/guides/{guideId}/activities/{activityId}', [ActivityController::class, 'update']);  // PUT /guides/{guideId}/activities/{activityId} - Update a specific activity for a guide
    Route::delete('/guides/{guideId}/activities/{activityId}', [ActivityController::class, 'destroy']); // DELETE /guides/{guideId}/activities/{activityId} - Delete a specific activity for a guide
    
});

// Authentication Routes
Route::post('/register', [AuthController::class, 'register']);  // POST /register - Register a new user
Route::post('/login', [AuthController::class, 'login']);        // POST /login - Log in a user
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum'); // POST /logout - Log out a user (Requires authentication)