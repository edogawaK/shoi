<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    public $table='detail';
    public $timestamps=false;
    public $primaryKey='detail_id';
    protected $guarded = [];

    public function product(){
        return $this->belongsTo(Product::class,'product_id','product_id');
    }

    public function size(){
        return $this->belongsTo(Size::class,'size_id','size_id');
    }
}
