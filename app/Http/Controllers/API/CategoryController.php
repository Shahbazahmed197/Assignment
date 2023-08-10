<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{


    public function category(Request $request)
    {
        $category = Category::with('products')->select(['id', 'name', 'created_at']);

        return DataTables::of($category)
            ->addColumn('number_of_products', function ($category) {
                return $category->products()->count();
            })
            ->editColumn('created_at', function ($category) {
                return Carbon::parse($category->created_at)->format('Y-m-d');
            })
            ->make(true);
    }
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query=Category::query();
        $query->when($request->has('name'), function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->input('name') . '%');
        });
        $categories = $query->select('id','name','slug')
        ->latest()->paginate(10);
        if (!$categories->isEmpty()) {
            $response = response()->json(["message" => "categories found", "categories" => $categories], 200);
        } else {
            $response = response()->json(["message" => "No category found", "categories" => $categories], 200);
        }
        return $response;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCategoryRequest $request)
    {
        // $validated = $request->validated();
        try {
            $category = Category::create([
                'name' => $request->input('name'),
                'slug' => generateSlug($request->name),
            ]);

            return response()->json(["message" => "New category added", "category" => $category], 200);
        } catch (\Exception $e) {
            return response()->json(["error" => "Failed to add category"], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::where('id', $id)->with('products.images:product_id,path')->first();
        if (!empty($category)) {
            $response = response()->json(["message" => "category found", "category" => $category], 200);
        } else {
            $response = response()->json(["message" => "No category found", "category" => $category], 422);
        }
        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AddCategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        if (!empty($category)) {
            $request=$request->json()->all();
            // Update category attributes
            $category->name = $request["name"] ?? $category->name;
            $category->slug = Str::slug($request["name"]?? $category->name);
            // Save the updated category
            $category->save();
            $response = response()->json(['message' => 'Category updated successfully', 'category' => $category]);
        } else {
            $response = response()->json(['message' => 'No category found', 'category' => $category]);
        }
        return $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if (!empty($category)) {
            // delete category
            $category->delete();
            $response = response()->json(['message' => 'Category deleted successfully', 'category' => $category]);
        } else {
            $response = response()->json(['message' => 'No category found', 'category' => $category]);
        }
        return $response;
    }
}
