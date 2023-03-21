<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);

        return response()->json($category);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:50',
            'slug' => 'required|unique:categories|max:50',
        ]);

        $category = Category::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug']
        ]);

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories|max:50',
            'slug' => 'required|unique:categories|max:50',
        ]);

        $category = Category::findOrFail($id);

        $category->update([
            'name' => $validatedData['name'],
        ]);

        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        $category->delete();

        return response()->json(null, 204);
    }
}