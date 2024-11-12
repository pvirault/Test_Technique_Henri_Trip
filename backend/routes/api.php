<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ActivityController;

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


Route::middleware(['auth:sanctum', 'check.admin'])->group(function () {

    // User Routes
    Route::get('/users', [UserController::class, 'index']);            // GET /users
    Route::get('/users/{id}', [UserController::class, 'show']);        // GET /users/{id}
    Route::put('/users/{id}', [UserController::class, 'update']);      // PUT /users/{id}
    Route::delete('/users/{id}', [UserController::class, 'destroy']);  // DELETE /users/{id}
    
    // Guide Routes
    Route::get('/guides', [GuideController::class, 'index']);            // GET /guides
    Route::post('/guides', [GuideController::class, 'store']);           // POST /guides
    Route::get('/guides/{id}', [GuideController::class, 'show']);        // GET /guides/{id}
    Route::put('/guides/{id}', [GuideController::class, 'update']);      // PUT /guides/{id}
    Route::delete('/guides/{id}', [GuideController::class, 'destroy']);  // DELETE /guides/{id}
    
    // Activity Routes (Nested under Guide)
    Route::get('/guides/{guideId}/activities', [ActivityController::class, 'index']);                // GET /guides/{guideId}/activities
    Route::post('/guides/{guideId}/activities', [ActivityController::class, 'store']);               // POST /guides/{guideId}/activities
    Route::get('/guides/{guideId}/activities/{activityId}', [ActivityController::class, 'show']);    // GET /guides/{guideId}/activities/{activityId}
    Route::put('/guides/{guideId}/activities/{activityId}', [ActivityController::class, 'update']);  // PUT /guides/{guideId}/activities/{activityId}
    Route::delete('/guides/{guideId}/activities/{activityId}', [ActivityController::class, 'destroy']); // DELETE /guides/{guideId}/activities/{activityId}
    
});

Route::post('/admin/login', [UserController::class, 'adminLogin'])->name('admin.login');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/register', [UserController::class, 'register'])->name('register');
