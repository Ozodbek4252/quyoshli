<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ProductsForPriceExport implements FromView
{
    public function view(): View
    {
        $products = Product::notChilds()->get();
        return view('dashboard.products.export', [
            'products' => $products
        ]);
    }
}
