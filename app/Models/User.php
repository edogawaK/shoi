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
    public $table='user';
    public $timestamps=false;
    public $primaryKey='user_id';
    public $fillable=[
        "user_name",
        "user_password",
        "user_email",
        "user_phone",
        "user_address",
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

    public function getAuthPassword()
    {
        return $this->user_password;
    }


    public function order(){
        return $this->hasMany(Order::class,'user_id',"user_id")->orderBy('order_date','desc');
    }

    public function cart(){
        return $this->hasMany(Cart::class,"user_id","user_id");
    }

}
