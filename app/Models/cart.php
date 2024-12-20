<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    protected $guarded=[];
//    public function product(){
//        return $this->belongsTo(Product::class);
//    }
//    public function color(){
//        return $this->belongsTo(color::class);
//    }
//
//    public function size(){
//        return $this->belongsTo(size::class);
//    }
    public function product_color_size(){
        return $this->belongsTo(product_color_size::class);
    }

}
