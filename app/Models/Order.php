<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $table='order';
    public $timestamps=false;
    public $primaryKey='order_id';
    protected $guarded = [];

    public function detail(){
        return $this->hasMany(Detail::class,'order_id','order_id')->with('product','size');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id','user_id');
    }
}
