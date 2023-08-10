@extends('layouts.master')
@section('title')
    Edit Product
@endsection
@section('content')
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container my-4">
                        <div id="responseMessage"></div>
                        <form id="productupdateForm" enctype="multipart/form-data">
                            @csrf

                            <!-- Product Name -->
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" value="{{ $product->name }}" class="form-control" id="productName"
                                    name="name" required>
                                    <input type="text" value="{{ $product->id }}" class="form-control" id="productid"
                                    name="product_id" hidden required>
                            </div>

                            <!-- Product Description -->
                            <div class="form-group">
                                <label for="productDescription">Product Description</label>
                                <textarea class="form-control" id="productDescription" name="description" rows="4" required>
                                    {{ $product->description }}
                                </textarea>
                            </div>

                            <!-- Product Categories (Multiple Select) -->
                            <div class="form-group">
                                <label for="productCategories">Categories</label>
                                <select class="form-control" id="productCategories" name="categories[]" multiple required>
                                    @foreach ($categories as $category)
                                        <option @if (in_array($category->id, $product_categories)) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product Images (Multiple Uploads) -->
                            <div class="form-group">
                                <label for="productImages">Product Images</label>
                                <input type="file" class="form-control-file" id="productImages" name="images[]" multiple
                                    accept="image/*" required>
                                <div id="imagePreview" class="d-flex flex-wrap pt-3">
                                    @foreach ($product->images as $image)
                                        <img src="{{ asset('storage/' . $image->path) }}" class="img-thumbnail mr-2 mb-2"
                                            style="max-height: 100px;">
                                    @endforeach
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <button type="button" class="btn btn-primary text-dark" onclick="updateProductForm()">
                                Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
