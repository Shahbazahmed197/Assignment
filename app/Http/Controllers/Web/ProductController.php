<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=Product::whereHas('images')
        ->with(['images','comments'=>function($query){
            $query->latest();
        },'comments.user:id,name'])->findOrFail($id);
        return view('front.product-detail', compact('product'));
    }
}
