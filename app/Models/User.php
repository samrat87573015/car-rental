<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
        'provider',
        'provider_id',
        'role',
    ];

    function rentals(){
        return $this->hasMany(Rental::class);
    }


    public static function isAdmin(){
        return  'admin';
    }

    function isCustomer(){
        return $this->role == 'customer';
    }


}
