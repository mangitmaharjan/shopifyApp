<?php

namespace App\Exports;
use App\Models\Product;
use App\Models\SoldProduct;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;



use Maatwebsite\Excel\Concerns\WithMapping;
class Products implements FromCollection, WithMapping
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }
    /**
    * @var Invoice $invoice
    */
    public function map($product): array
    {
        $status = $product->sold ? 'true': 'false';
        return [
            $product->product_id,
            $product->name,
            $product->code,
            $product->price,
            'http://greekgear.com/'.$product->product_id.'.html',
            $status
        ];
    }
}
