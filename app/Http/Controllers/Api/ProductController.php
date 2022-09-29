<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('title')->paginate();

        $productsList = $products->map(function ($product) {
            return [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'price' => $product->price
            ];
        });

        return response()->json([
            'products' => $productsList,
            'current_page' => $products->currentPage(),
            'total' => $products->total(),
            'last_page' => $products->lastPage(),
        ], 200);
    }

    public function show(Product $product)
    {
        return response()->json([
            'id' => $product->id,
            'title' => $product->title,
            'description' => $product->description,
            'price' => $product->price
        ], 200);
    }

    public function store()
    {
//        $data = $request->validated();
//
//        Product::firstOrCreate($data['name']);
//
//        return redirect()->route('dashboard.product.index');
    }


}
