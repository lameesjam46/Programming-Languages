<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product_color_size extends Model
{
    protected $guarded=[];
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function color(){
        return $this->belongsTo(color::class);
    }

    public function size(){
        return $this->belongsTo(size::class);
    }
    public function cart(){
        return $this->hasMany(cart::class);
    }
}
