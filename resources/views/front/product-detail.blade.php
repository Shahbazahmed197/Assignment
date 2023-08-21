@extends('layouts.front')
@section('content')
    <div class="container">
        <span>
            <a class="btn btn-info" href="{{ route('web-category.index') }}">
                Back</a>
        </span><br>
        <div class="row">
            <div class="col-md-2 mb-4"></div>
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div id="imagePreview" class="d-flex flex-wrap pt-3">
                            @foreach ($product->images as $image)
                                <img src="{{ asset('storage/' . $image->path) }}" class="img-thumbnail mr-2 mb-2"
                                    style="max-height: 100px;">
                            @endforeach
                        </div>
                        {{-- <img width="100px" height="100px" src="{{ asset('storage/' . $product->images[0]->path) }}"
                            alt=""> --}}
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <h5 class="card-title">Description:</h5>
                        <p class="text-dark">{{ $product->description }}</p>
                        <!-- Comment Section -->
                        <div class="comments-section py-5">
                            <h5>Comments and Feedback</h5>

                            <!-- Display existing comments -->
                            <div id="commentContainer">
                            @foreach ($product->comments as $comment)
                                <div class="comment py-3">
                                    <span><strong> {{ $comment->user->name }}&nbsp;</strong></span><span><small>
                                            {{ $comment->created_at->format('d M, Y') }}</small></span>
                                    <p>{{ $comment->rating }} Stars</p>
                                    <p>{{ $comment->content }}</p>

                                </div>
                                <hr>
                            @endforeach
                        </div>
                            <h5 class="text-center pt-3">Add a Comment</h5>
                            <!-- Comment Form -->
                            <form action="{{ route('comment.store') }}" method="POST" class="mt-4" id="commentForm">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="form-group">
                                    <label for="rating">Rating (1-5)</label>
                                    <input type="number" name="rating" id="rating" class="form-control" min="1"
                                        max="5" step="1" required>
                                </div>
                                <div class="form-group">
                                    <label for="content">Write your comment here</label>
                                    <textarea name="comment" id="content" class="form-control" rows="5" required></textarea>
                                </div>
                                <button type="button" class="btn btn-primary text-dark "
                                    onclick="submitcommentForm()">Submit Comment</button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
