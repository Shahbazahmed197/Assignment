<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('front.categories', compact('categories'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category=Category::whereHas('products.images')
        ->with('products.images')->findOrFail($id);
        return view('front.products', compact('category'));
    }
}
