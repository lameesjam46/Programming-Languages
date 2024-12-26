<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;
use App\Traits\UplodeImageTrait;
use Illuminate\Http\Request;

class insertdbcontroller extends Controller
{
    use UplodeImageTrait;
    public function storeImageSrore(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'description'=>'required|string|max:255'
        ]);
        $pathe=$this->upludeImage($request,'store');
        Store::query()->create([
            'name'=>$request->name,
            'image'=>$pathe,
            'description'=>$request->description
        ]);

    }



    public function insertProducts(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'description'=>'required|string|max:255'
        ]);
        $pathe = $this->upludeImage($request, 'products');
        Product::query()->create([
            'name' => $request->name,
            'image' => $pathe,
            'description' => $request->description,
            'store_id'=>$request->store_id
        ]);
    }
}
