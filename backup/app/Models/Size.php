<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    public $table='size';
    public $timestamps=false;
    public $primaryKey='size_id';
    protected $guarded = [];
}
