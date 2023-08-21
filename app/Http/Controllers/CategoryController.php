<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCategoryRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function index(){
        return view('category.index');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.form');
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
        $category = Category::find($id);
        $view=1;
        return view('category.form', compact(['category','view']));
        }
 /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('category.form', compact('category'));
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
        if ($category->products()->count() > 0) {
            return response()->json(['success'=>false,'message' => 'Cannot delete category with associated products', 'data' => $category],Response::HTTP_CONFLICT);
        }
        if (!empty($category)) {
            // delete category
            $category->delete();
            $response = response()->json(['success'=>true,'message' => 'Category deleted successfully', 'data' => $category]);
        } else {
            $response = response()->json(['success'=>false,'message' => 'No category found', 'data' => $category],Response::HTTP_CONFLICT);
        }
        return $response;
    }
    public function category(Request $request)
    {
        $category = Category::with('products')->select(['id', 'name', 'created_at']);

        return DataTables::of($category)
            ->addColumn('number_of_products', function ($category) {
                return $category->products()->count();
            })
            ->editColumn('created_at', function ($category) {
                return Carbon::parse($category->created_at)->format('d-m-Y');
            })
            ->make(true);
    }
}
