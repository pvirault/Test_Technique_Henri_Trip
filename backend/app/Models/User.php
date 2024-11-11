<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Methods to check the user's role

    /**
     * Checks if the user is an administrator.
     * 
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Checks if the user is a regular user.
     * 
     * @return bool
     */
    public function isUser()
    {
        return $this->role === 'user';
    }

    // GUIDE PERMISSIONS

    /**
     * Checks if the user has permission to create a guide.
     * 
     * @return bool
     */
    public function canCreateGuide()
    {
        return $this->isAdmin();
    }

    /**
     * Checks if the user has permission to edit a guide.
     * 
     * @return bool
     */
    public function canEditGuide()
    {
        return $this->isAdmin();
    }

    /**
     * Checks if the user has permission to delete a guide.
     * 
     * @return bool
     */
    public function canDeleteGuide()
    {
        return $this->isAdmin();
    }

    // ACTIVITY PERMISSIONS

    /**
     * Checks if the user has permission to manage activities in a guide.
     * 
     * @return bool
     */
    public function canManageActivity()
    {
        return $this->isAdmin();
    }

    /**
     * Checks if the user has permission to create an activity.
     * 
     * @return bool
     */
    public function canCreateActivity()
    {
        return $this->isAdmin();
    }

    /**
     * Checks if the user has permission to edit an activity.
     * 
     * @return bool
     */
    public function canEditActivity()
    {
        return $this->isAdmin();
    }

    /**
     * Checks if the user has permission to delete an activity.
     * 
     * @return bool
     */
    public function canDeleteActivity()
    {
        return $this->isAdmin();
    }

    // USER MANAGEMENT PERMISSIONS

    /**
     * Checks if the user has permission to create a new user.
     * 
     * @return bool
     */
    public function canCreateUser()
    {
        return $this->isAdmin();
    }

    /**
     * Checks if the user has permission to delete a user of type 'user'.
     * 
     * @return bool
     */
    public function canDeleteUser()
    {
        return $this->isAdmin();
    }
}
