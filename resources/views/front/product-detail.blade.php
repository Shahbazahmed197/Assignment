@extends('layouts.front')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-2 mb-4"></div>
            <div class="col-md-8 mb-4">
                <div class="card">
                    <div class="card-body">
                        <img width="100px" height="100px" src="{{ asset('storage/' . $product->images[0]->path) }}"
                            alt="">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="text-dark">{{ $product->description }}</p>
                <!-- Comment Section -->
                <div class="comments-section py-5">
                    <h1>Comments and Feedback</h1>

                    <!-- Display existing comments -->
                    @foreach ($product->comments as $comment)
                        <div class="comment py-3">
                            <p>{{ $comment->content }}</p>
                            <small>{{ $comment->created_at->format('d M, Y') }}</small>
                        </div>
                    @endforeach
                    <h1 class="text-center">Add a Comment</h1>
                    <!-- Comment Form -->
                    <form action="{{ route('products.comment') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="form-group">
                            <label for="rating">Rating (1-5)</label>
                            <input type="number" name="rating" id="rating" class="form-control" min="1" max="5" step="1" required>
                        </div>
                        <div class="form-group">
                            <label for="content">Write your comment here</label>
                            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary text-dark ">Submit Comment</button>
                    </form>
                </div>

            </div>
        </div>

            </div>
        </div>
    </div>
@endsection
