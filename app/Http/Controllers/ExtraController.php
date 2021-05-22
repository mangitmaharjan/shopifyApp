<?php

namespace App\Http\Controllers;
use App\Imports\Products;
use App\Exports\Products as PExport;

use App\Models\Product;
use App\Models\SoldProduct;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Http;

class ExtraController extends Controller
{
    public function index(Request $request){

        return (new PExport())->download('Sold Product Not found on Sheet.xlsx');
        die;
        return view('extra.index');
        dd('heres');
        // $response = Http::get('http://greekgear.com/');
        // dd($response->status());
        $sold_product = Product::where('sold',1)->count();
        $notfound = SoldProduct::where('notfound',1)->count();
        $notsold = Product::where('sold',0)->count();
        $notsoldIds = Product::where('sold',0)->get('product_id')->toArray();
        $data = [
            'sold' =>$sold_product,
            'not_found' => $notfound,
            'notsold'=>$notsold,
            'notsoldIds'=>json_encode($notsoldIds)
        ];
        dd($data);
        // $sold_product = SoldProduct::all();
        // foreach($sold_product as $sp){
        //     $product = Product::where('product_id', $sp->product_id)->first();
        //     if(!$product){
        //         // dd($sp);
        //         // dd('Product Not found');
        //         $sp->notfound = true;
        //         $sp->update();
        //     }else{
        //         $product->sold = true;
        //         $product->update();
        //     }


        // }
        // dd('Complete');
        // dd($product);
        // dd($sold_product);
        // return view('extra.index');
    }

    public function submit(Request $request){
        dd('Stopped');
        set_time_limit(3000);
        $path = $request->file('file')->getRealPath();
        $data = Excel::toArray(new Products, $request->file('file'));


        foreach ($data[0] as $key => $item) {

            $product = Product::where('product_id', $item[0])->first();
            if(!$product){
                dd('Product Not found');
            }else{
                $product->name = $item[3];
                $product->code = $item[1];
                $product->price = $item[2];
                $product->update();
            }
        }
        dd('DONE');
    // // return response()->json(["rows"=>$rows]);
    //     $p = [];
    //     foreach ($data[0] as $key => $item) {

    //         SoldProduct::create([
    //             'product_id'=>$item[0]
    //         ]);

    //     }
    //     dd($p);
    //     // dd('here');
    }
}
