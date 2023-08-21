<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\AddCommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(AddCommentRequest $request)
    {

        // create logic for product
        $comment = Comment::create([
            'content' => $request->comment,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'user_id'=>auth()->user()->id
        ]);
        return response()->json(["success"=>true,"message" => "New comment added",
        'data' => [
            'user_name' => auth()->user()->name,
            'updated_at' => now()->format('d M, Y'),
            'content' => $comment->content,
            'rating' => $comment->rating,
        ]], 200);
    }
}
