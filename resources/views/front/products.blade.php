@extends('layouts.front')
@section('content')
  <div class="container">
    <strong class="py-3"> Products</strong>
    <div class="row">
      @foreach($category->products as $product)
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body">
                <img width="100px" height="100px" src="{{ asset('storage/'.$product->images[0]->path) }}" alt="">
              <h5 class="card-title">{{ $product->name }}</h5>
              <a href="{{ route('product_detail',$product->id) }}" class="btn btn-primary">View Detail</a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection
