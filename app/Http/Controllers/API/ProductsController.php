<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Products::all()->toArray();
        return array_reverse($products);
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required',
        ]);
        $input = $request->all();
        $imageName = NULL;
        if ($image = $request->file('file')) {
            $destinationPath = '/img';
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imageName);
            $input['image'] = $imageName;
        }

        Products::create($input);

        return response()->json(['success' => 'Product created successfully']);
    }
}
