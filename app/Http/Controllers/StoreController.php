<?php

namespace App\Http\Controllers;
use App\Models\cart;
use App\Models\color;
use App\Models\Order;
use App\Models\Product;
use App\Models\product_color_size;
use App\Models\Store;
use App\Traits\UplodeImageTrait;
use Illuminate\Http\Request;


class StoreController extends Controller
{

    public function getAllStore(){
      $stores = Store::query()->get()->all();
      return response()->json(['msg'=>'successfully','data'=>$stores,'status'=>200]);
    }

    public function getAllProducts($id){
        $products=Product::query()->where('store_id','=',$id)->get();
        return response()->json(['msg'=>'successfully','data'=>$products,'status'=>200]);
    }


    public function getOneProduct($id){
        $product=[];
      $product['pro']=Product::query()->where('id','=',$id)
          ->select('id','name','image','description','store_id')
         -> with('store:id,name')->get();

        $product['color_size']=product_color_size::query()->where('product_id','=',$id)
            ->select('id','product_id','color_id','size_id','quantity','price')->with(['color:id,nameColor','size:id,size'])->get();

//        $product['size']=product_color_size::query()->where('product_id','=',$id)
//            ->select('size_id')->with(['size:id,size'])->get();

//        foreach ($color_id as $col){
//        $product['color']=color::query()->where('id','=',$col)->find($product[$id]);}

//        $products=product_color_size::query()->select('product_id','color_id','size_id')
//            ->with(['product:id,name,price,description,image,store_id','color:id,nameColor','size:id,size',
//                'product.store:id,name'])->find($product[$id]);
        return response()->json(['msg'=>'successfully','data'=>$product,'status'=>200]);
    }

   public function addToCart(Request $request){
        cart::query()->create([
            'product_color_size_id'=>$request->product_color_size_id,
            'user_id'=>$request->user_id
        ]);


       return response()->json(['msg'=>'successfully','status'=>200]);
//        $request->validate([
//            'product_id'=>'required',
//            'color_id'=>'required',
//            'size_id'=>'required',
//
//        ]);
//        $price=product_color_size::query()->where('product_id','=',$request->product_id)
//       ->where('color_id','=',$request->color_id)
//       ->where('size_id','=',$request->size_id)
//       ->first();

//        cart::query()->create([
//            'product_id'=>$request->product_id,
//            'color_id'=>$request->color_id,
//            'size_id'=>$request->size_id,
//            'price'=>$price->price,
//            'user_id'=>1
//        ]);
//       $quantityl=product_color_size::query()
//            ->where('product_id','=',$request->product_id)
//            ->where('color_id','=',$request->color_id)
//            ->where('size_id','=',$request->size_id)
////            ->get();
//       $quantityl=product_color_size::find($id);
//
//       $quantitold=$quantityl->quantity;
//
//       $newquant=$quantitold-1;
//       $quantityl->quantity=$newquant;
//       $quantityl->save();
////       product_color_size::query()
////           ->where('product_id','=',$request->product_id)
////           ->where('color_id','=',$request->color_id)
////           ->where('size_id','=',$request->size_id)
////           ->update(['quantity'=>$quantity]);
//     //  $quantity=product_color_size::query()->where('id','=',$ID)->select('quantity')->get();
//        return response()->json(['msg'=>'The Product Add To The Cart','data'=>$quantityl]);

   }

//   public function getcart($id){
//       $price=0;
//       $cart=[];
//        $cart['product']=cart::query()->where('user_id','=',$id)->select('product_id','color_id','size_id','price')
//            ->with(['product:id,name,image,description,store_id','color:id,nameColor','size:id,size','product.store:id,name'])
//            ->get();
//        $priceTotal=cart::query()->where('user_id','=',$id)->select('price')->get();
//        foreach ($priceTotal as $total){
//            $price=$price+$total->price;
//        }
//       $cart['priceTotal']=$price;
//
//        return response()->json(['msg'=>'successfully','data'=>$cart]);
//   }


   public function getCart2($user_id){
        $cart=[];
        $idd=[];
//       $mm=0;
       $dd=0.0;
       $pr=0;
        $cart['pro']=cart::query()->where('user_id','=',$user_id)->select('id','product_color_size_id')
            ->with(['product_color_size:id,product_id,color_id,size_id,price','product_color_size.product:id,name,image,description,store_id','product_color_size.color:id,nameColor','product_color_size.size:id,size','product_color_size.product.store:id,name'])
            ->get();
        $lkl=cart::query()->where('user_id','=',$user_id)->select('product_color_size_id')->get();
        foreach ($lkl as $item){
            $idd[]=$item->product_color_size_id;
        }
        foreach ($idd as $Id){
         $mm= product_color_size::query()->where('id','=',$Id)->select('price')->first();
         $dd=$dd+$mm->price;
        }
       $cart['priceTotal']=$dd;
//       $price=cart::query()->where('user_id','=',$user_id)
//           ->with('product_color_size_id.price')->get();
//
//       $pr=$pr+$mm->price;


        return response()->json(['msg'=>'get','data'=>$cart,'status'=>200]);

   }

    //cancel order
    public function cancelOrder($user_id){
//        $quantity=[];
        $ll= cart::query()->where('user_id','=',$user_id)->get();


        foreach ($ll as $item){
            $ii[]=$item->product_color_size_id;
        }
        foreach ($ii as $product_color_size_id){
             $prod=product_color_size::query()->where('id','=',$product_color_size_id)->get();
            foreach ($prod as $rr ){
                $tt=$rr->quantity;
                $quantity=$tt+1;
                $rr->quantity=$quantity;
                $rr->save();
            }

        }
            $cancel=cart::query()->where('user_id','=',$user_id)->delete();
            return response()->json(['msg'=>'cancel order OK','data'=>$quantity,'status'=>200]);



    }
    //install order
    public function installOrder($user_id){
        $ii=[];
        $ll= cart::query()->where('user_id','=',$user_id)->get();

        foreach ($ll as $item){
            $ii[]=$item->product_color_size_id;
        }
        foreach ($ii as $product_color_size_id){

            Order::query()->create([
                'cartToOrder'=>$product_color_size_id,
                'user_id'=>$user_id
        ]);
        }
        return response()->json(['msg'=>'successfully','status'=>200]);

    }
    //update order
    public function updateOrder($product_color_size_id){

        cart::query()->where('product_color_size_id','=',$product_color_size_id)->delete();
        return response()->json(['msg'=> 'successfully','status'=>200]);
    }


    public function getAllOrder($user_id){

        $Order=Order::query()->where('user_id','=',$user_id)->select('id','product_color_size_id','created_at','updated_at')
            ->with(['product_color_size:id,product_id,color_id,size_id,price','product_color_size.product:id,name,image,description,store_id','product_color_size.color:id,nameColor','product_color_size.size:id,size','product_color_size.product.store:id,name'])
            ->get();


            return response()->json(['msg'=>'successfully','data'=>$Order,'status'=>200]);
    }
}
