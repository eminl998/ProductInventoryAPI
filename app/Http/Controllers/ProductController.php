<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json(compact('products'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id'
        ]);

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

    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'brand' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'nullable|exists:categories,id'
        ]);

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