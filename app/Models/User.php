<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
/** Dealing with the laravel sanctum */
use Laravel\Sanctum\HasApiTokens;
/** for dealing with laravel spatie */
use Spatie\Permission\Traits\HasRoles;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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


    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * Get all of the favouriates for the User
     */
    public function favouriates()
    {
        return $this->hasMany(Favouriate::class);
    }



    /**
     * Get all of the likes for the User
     */
    public function likes()
    {
        return $this->hasMany(LIke::class, 'foreign_key', 'local_key');
    }
}
