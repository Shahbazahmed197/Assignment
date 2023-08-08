<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class FrontController extends Controller
{
    public function categories()
    {
        $categories = Category::withCount('products')->get();
        return view('front.categories', compact('categories'));
    }
    public function categoryProducts($id)
    {
        $category=Category::whereHas('products.images')
        ->with('products.images')->findOrFail($id);
        return view('front.products', compact('category'));
    }
    public function ProductDetail($id)
    {
        $product=Product::whereHas('images')
        ->with(['images','comments'])->findOrFail($id);

        return view('front.product-detail', compact('product'));
    }
    public function postProductComment(Request $request)
    {
            // Validate input
            $request->validate([
                'content' => 'required|string|max:255',
                'rating' => 'required',
                'product_id' => 'required|exists:products,id',
            ]);
            // create logic for product
            $product = Comment::create([
                'content' => $request->content,
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                // Other fields
            ]);
        return redirect()->back()->with('success','comment added successfully');
    }
}
