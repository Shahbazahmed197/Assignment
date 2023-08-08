<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function products()
    {
    $products = Product::with('categories')->select(['id', 'name','created_at']);

    return DataTables::of($products)
        ->addColumn('categories', function ($product) {
            return implode(', ', $product->categories()->pluck('name')->toArray());
        })
        ->editColumn('created_at', function ($product) {
            return Carbon::parse($product->created_at)->format('Y-m-d');
        })
        ->make(true);
}

     public function index(Request $request)
    {
        $products = Product::latest()->paginate(10);
        if (!$products->isEmpty()) {
            $response = response()->json(["message" => "products found", "products" => $products], 200);
        } else {
            $response = response()->json(["message" => "No product found", "products" => $products], 200);
        }
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::get(['id','name']);
        return view('products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'images' => 'required|array|min:1', // At least one image is required
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate each image
            'categories' => 'required|array|min:1', // At least one category is required
            'categories.*' => Rule::exists('categories', 'id'), // Validate each category
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        // create logic for product
        $product = Product::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            // Other fields
        ]);
        // Attach categories to the product
        $product->categories()->attach($request->input('categories'));

        // Upload and associate images with the product
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                // $image= Image::make($image)
                // ->encode('jpg', 80);
                $path = $image->store('product_images', 'public');
                $product->images()->create(['path' => $path]);
            }
        }

        return response()->json(['message' => 'Product created successfully', 'product' => $product], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::where('id', $id)->with(['images:product_id,path', 'categories:name'])->first();
        if (!empty($product)) {
            $response = response()->json(["message" => "product found", "product" => $product], 200);
        } else {
            $response = response()->json(["message" => "No product found", "product" => $product], 422);
        }
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

            $categories=Category::get(['id','name']);
            $product=Product::where('id',$id)->with(['categories','images'])->first();
            return view('products.edit',compact('categories','product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            $request=$request->json()->all();
            // Update product attributes
            $product->name = $request["name"] ?? $product->name;
            $product->description = $request["description"] ?? $product->description;
            $product->slug = Str::slug($request["name"]  ?? $product->name);


            // Remove previous categories and sync the new ones
            if (isset($request["categories"])) {
                $product->categories()->sync($request["categories"]);
            }
            // Remove previous images and attach the new ones
            // if ($request['images']){
            //     $product->images()->delete();
            //     foreach ($request['images'] as $image) {
            //         $path = $image->store('product_images', 'public');
            //         $product->images()->create(['path' => $path]);
            //     }
            // }
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
