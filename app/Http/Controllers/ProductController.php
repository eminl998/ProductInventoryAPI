<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest\StoreRequest;
use App\Http\Requests\ProductRequest\UpdateRequest;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate();
        return response()->json(ProductResource::collection($products));
    }

    public function store(StoreRequest $request)
    {
        $validatedData = $request->validate;

        $product = new Product();
        $product->name = $validatedData['name'];
        $product->brand = $validatedData['brand'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];
        $product->save();

        return response()->json($product, 201);
    }



    public function show(Product $product)
    {
        return response()->json(compact('product'));
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $validatedData = $request->validate;

        $product->name = $validatedData['name'];
        $product->brand = $validatedData['brand'];
        $product->price = $validatedData['price'];
        $product->category_id = $validatedData['category_id'];
        $product->save();

        return response()->json($product);
    }

    public function delete(Product $product)
    {
        $product->delete();
        return response()->json(['success' => true]);
    }
}