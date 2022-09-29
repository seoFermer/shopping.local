<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('title')->paginate();
        return view('backend.product.index', compact('products'));
    }

    public function show(Product $product)
    {
        return view('backend.product.show', compact('product'));
    }

    public function create()
    {
        return view('backend.product.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        Product::firstOrCreate($data);

        return redirect()->route('dashboard.product.index');
    }

    public function edit(Product $product)
    {
        return view('backend.product.edit', compact('product'));
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);

        return redirect()->route('dashboard.product.show', $product->id);
    }

    public function delete(Product $product)
    {
        $product->delete();

        return redirect()->route('dashboard.product.index');
    }
}
