<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function getReview(){
        return view('frontend.review');
    }
    public function check(Request $request){
        $customer_id= $request->customer_id;
        $product_id= $request->product_id;
        $review = Review::where('customer_id',$customer_id)
                                ->where('product_id',$product_id)
                                ->first();
        if($review){
            return true;
        }
        return false;
    }

    public function bulkCheck(Request $request){
        $customer_id= $request->customer_id;
        $product_ids= $request->product_ids;
        $res = [];
        $active = [];
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
}
