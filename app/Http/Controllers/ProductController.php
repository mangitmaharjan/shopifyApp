<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Auth;
class ProductController extends Controller
{
    public function index(Request $request){
        $shop = Auth::user();
        $request = $shop->api()->rest('GET', '/admin/api/2020-10/products.json');
        // $request = $shop->api()->graph('{ shop { name } }');
        return view('backend.product.index');
        dd($request['body']);
        die;
        echo $request['body']['shop']['name'];
    }
}
