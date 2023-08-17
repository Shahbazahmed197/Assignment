<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
        $query->when($request->has('name'), function ($query) use ($request) {
            return $query->where('name','Like','%'.$request->name .'%');
        });
        $query->when($request->has('category'), function ($query) use ($request) {
           return $query->whereHas('categories', function ($subquery) use ($request) {
                $subquery->where('category_id', $request->category);
            });
        });
        $products = $query
            ->select([
                'id', 'name', 'slug', 'description',
                DB::raw('DATE_FORMAT(created_at,"%d-%M-%Y") AS listed_on')
            ])
            ->latest()
            ->paginate(10);
        if (!$products->isEmpty()) {
            $response = response()
            ->json(["message" => count($products)." "."products found","success"=>true, "data" => $products], 200);
        } else {
            $response = response()->json(["message" => "No product found","success"=>false, "data" => $products], 200);
        }
        return $response;
    }
}
