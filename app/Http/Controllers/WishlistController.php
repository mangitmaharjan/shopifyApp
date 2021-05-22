<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
class WishlistController extends Controller
{
    public function check(Request $request){
        $customer_id= $request->customer_id;
        $product_id= $request->product_id;
        $wishlist = Wishlist::where('customer_id',$customer_id)
                                ->where('product_id',$product_id)
                                ->first();
        if($wishlist){
            return true;
        }
        return false;
    }

    public function bulkCheck(Request $request){
        $customer_id= $request->customer_id;
        $product_ids= $request->product_ids;
        $res = [];
        $active = [];
        if($product_ids){
            foreach($product_ids as $product_id){
                $status = false;
                $wishlist = Wishlist::where('customer_id',$customer_id)
                    ->where('product_id',$product_id)
                    ->first();
                if( $wishlist){
                    $status = true;
                }
                $res['products'][] = [
                    'product_id' => $product_id,
                    'status' => $status
                ];
                if($status){
                    $active[] = $product_id;
                }
            }
        }
        $res['active'] = $active;

      return json_encode($res);
      die;
    }

    public function add(Request $request){
        Wishlist::create([
            'customer_id'=> $request->customer_id,
            'product_id'=> $request->product_id
        ]);
        return true;
    }
    public function remove(Request $request){
        Wishlist::where('customer_id', $request->customer_id)
                ->where('product_id', $request->product_id)
                ->delete();
        return true;
    }

    public function getAllProduct(Request $request, $customer_id){
        $res = [
            'status' => false
        ];
        $wishlist = Wishlist::where('customer_id',$customer_id)
                                ->get('product_id');
        $product_arr = [];
        foreach($wishlist as $p){
            $product_arr[] = $p->product_id ;

        }
        if($wishlist){
            $res['status']  = true;
            $res['product_id'] = $product_arr;

        }
        return json_encode($res);
    }
}
