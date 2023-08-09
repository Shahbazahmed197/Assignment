@extends('layouts.master')

@section('title')
    Add Product
@endsection

@section('content')
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container my-4">
                        <div id="responseMessage"></div>
                        <form id="productForm" enctype="multipart/form-data">
                            @csrf

                            <!-- Product Name -->
                            <div class="form-group">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="name" required>
                            </div>

                            <!-- Product Description -->
                            <div class="form-group">
                                <label for="productDescription">Product Description</label>
                                <textarea class="form-control" id="productDescription" name="description" rows="4" required></textarea>
                            </div>

                            <!-- Product Categories (Multiple Select) -->
                            <div class="form-group">
                                <label for="productCategories">Categories</label>
                                <select class="form-control" id="productCategories" name="categories[]" multiple required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product Images (Multiple Uploads) -->
                            <div class="form-group">
                                <label for="productImages">Product Images</label>
                                <input type="file" class="form-control-file" id="productImages" name="images[]" multiple
                                    accept="image/*" required>
                            </div>

                            <!-- Submit Button -->
                            <button type="button" class="btn btn-primary text-dark" onclick="createProductForm()">Add
                                Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
