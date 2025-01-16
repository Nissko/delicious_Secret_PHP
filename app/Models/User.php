<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'patronymic',
        'phone',
        'email',
        'password',
        'photo'
    ];

    public function rates(){
        return $this->hasMany(Rate::class);
    }

    public function recipes(){
        return $this->hasMany(Recipe::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
}
