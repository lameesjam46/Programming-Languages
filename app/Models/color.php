<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class color extends Model
{
    public function product_color_size(){
        return $this->hasMany(product_color_size::class);
    }
    public function cart(){
        return $this->hasMany(cart::class);
    }
}
