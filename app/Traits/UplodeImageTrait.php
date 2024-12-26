<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait UplodeImageTrait
{
    public function upludeImage(Request $request,$folder){
        $images=$request->file('image')->getClientOriginalName();
        $path=$request->file('image')->storeAs($folder,$images,'prod');
        return $path;
    }

}
