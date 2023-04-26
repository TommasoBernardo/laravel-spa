<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('products')->paginate(6);
        return response()->json([
            'succes' => true,
            'results' => $products
        ]);
    }
}
