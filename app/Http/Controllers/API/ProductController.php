<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
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
        $products = Product::with('categories')->select(['id', 'name', 'created_at']);

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
        $query = Product::query();
        $query->when($request->has('name'), function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->input('name') . '%');
        });
        $products = $query
            ->select([
                'id', 'name', 'slug', 'description',
                DB::raw('DATE_FORMAT(created_at, "%d-%M-%Y") AS listed_on')
            ])
            ->latest()
            ->paginate(10);
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
        $categories = Category::get(['id', 'name']);
        return view('products.create', compact('categories'));
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
            'description' => $request->description,
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

        $categories = Category::get(['id', 'name']);
        $product = Product::where('id', $id)->with(['categories', 'images'])->first();
        $product_categories = $product->categories()->pluck('category_id')->toArray();
        return view('products.edit', compact('categories', 'product', 'product_categories'));
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
            $product->description = $request["description"] ?? $product->description;
            $product->slug = Str::slug($request["name"]  ?? $product->name);


            // Remove previous categories and sync the new ones
            if (isset($request["categories"])) {
                $product->categories()->sync($request["categories"]);
            }
            // Remove previous images and attach the new ones
            if ($request->hasFile('images')) {
                foreach ($product->images as $stored_image) {
                    File::delete(public_path('storage/', $stored_image->path));
                    $stored_image->delete();
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
