@extends('layouts.front')
@section('content')
  <div class="container">
    <strong class="py-3">All Categories</strong>
    <div class="row">
      @foreach($categories as $category)
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">{{ $category->name }}</h5>
              <p class="card-text">Total Product: {{ $category->products_count }}</p>
              <a href="{{ route('products',$category->id) }}" class="btn btn-primary">View Products</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
