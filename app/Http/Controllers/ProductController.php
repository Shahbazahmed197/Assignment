<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManagerStatic as Image;
class ProductController extends Controller
{
 /**
     * Display a data-table of the resource.
     */
    public function products()
    {
        $products = Product::with('categories')->select(['id', 'name', 'created_at']);

        return DataTables::of($products)
            ->addColumn('categories', function ($product) {
                return implode(', ', $product->categories()->pluck('name')->toArray());
            })
            ->editColumn('created_at', function ($product) {
                return Carbon::parse($product->created_at)->format('d-m-Y');
            })
            ->make(true);
    }
     /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get(['id', 'name']);
        return view('products.form', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // create logic for product
        $product = Product::create([
            'name' => $request->name,
            'slug' => generateSlug($request->name),
            'description' => trim($request->description),
            // Other fields
        ]);
        // Attach categories to the product
        $product->categories()->attach($request->input('categories'));

        // Upload and associate images with the product
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $originalExtension = $image->getClientOriginalExtension();
                $image = Image::make($image)->resize('250', '250')->encode();
                $filename = 'image_' . time() .'.'. $originalExtension; // Generate a unique filename
                $imagePath = 'product_images/' . $filename;
                Storage::disk('public')->put($imagePath, $image);
                // $path = $image->store('product_images', 'public');
                $product->images()->create(['path' => $imagePath]);
            }
        }

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::get(['id', 'name']);
        $product = Product::where('id', $id)->with(['categories', 'images'])->first();
        $product_categories = $product->categories()->pluck('name')->toArray();
        $view=1;
        return view('products.form', compact('categories','view', 'product', 'product_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $categories = Category::get(['id', 'name']);
        $product = Product::where('id', $id)->with(['categories', 'images'])->first();
        $product_categories = $product->categories()->pluck('category_id')->toArray();
        return view('products.form', compact('categories', 'product', 'product_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProduct(ProductRequest $request)
    {
        $product = Product::find($request['product_id']);
        if (!empty($product)) {
            // Update product attributes
            $product->name = $request["name"] ?? $product->name;
            $product->description = trim($request["description"]) ?? $product->description;
            $product->slug = Str::slug($request["name"]  ?? $product->name);


            // Remove previous categories and sync the new ones
            if (isset($request["categories"])) {
                $product->categories()->sync($request["categories"]);
            }
            // Remove previous images and attach the new ones
            if ($request->hasFile('images')) {
                foreach ($product->images as $storedImage) {
                    File::delete(public_path('storage/', $storedImage->path));
                    $storedImage->delete();
                };
                foreach ($request->file('images') as $image) {
                    $originalExtension = $image->getClientOriginalExtension();
                $image = Image::make($image)->resize('250', '250')->encode();
                $filename = 'image_' . time() .'.'. $originalExtension; // Generate a unique filename
                $imagePath = 'product_images/' . $filename;
                Storage::disk('public')->put($imagePath, $image);
                $product->images()->create(['path' => $imagePath]);
                }
            }
            $product->save();
            $response = response()->json(['message' => 'product updated successfully', 'product' => $product]);
        } else {
            $response = response()->json(['message' => 'No product found', 'product' => $product]);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            // delete product
            $product->delete();
            $response = response()->json(['message' => 'product deleted successfully', 'product' => $product]);
        } else {
            $response = response()->json(['message' => 'No product found', 'product' => $product]);
        }
        return $response;
    }
}
