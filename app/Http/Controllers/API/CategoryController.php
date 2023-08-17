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
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query=Category::query();
        $query->when($request->has('name'), function ($query) use ($request) {
            return $query->where('name', 'like', '%' . $request->name . '%');
        });
        $categories = $query->select('id','name','slug')->withCount('products')
        ->latest()->paginate(10);
        if (!$categories->isEmpty()) {
            $response = response()->json(["message" => count($categories)." "."categories found","success"=>true, "data" => $categories], 200);
        } else {
            $response = response()->json(["message" => "No category found", "success"=>false,"data" => $categories], 200);
        }
        return $response;
    }


}
