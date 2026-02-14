<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'username',
        'profile_picture',
        'phone_number',
        'date_of_birth',
        'remarks',
        'password_reset_token',
        'password_reset_token_expires_at',
        'password_reset_token_requested_at',
        'email_verification_token',
        'email_verification_token_requested_at',
        'email_verification_token_expires_at',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'password_reset_token',
        'email_verification_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'password_reset_token_expires_at' => 'datetime',
        'password_reset_token_requested_at' => 'datetime',
        'email_verification_token_requested_at' => 'datetime',
        'email_verification_token_expires_at' => 'datetime',
    ];
}
