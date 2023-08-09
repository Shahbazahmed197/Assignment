@extends('layouts.master')

@section('title')
    Edit Category
@endsection

@section('content')
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container my-4">
                        <div id="responseMessage"></div>
                        <form id="categoryForm" enctype="multipart/form-data">
                            @csrf

                            <!-- Category Name -->
                            <div class="form-group">
                                <label for="CategoryName">Category Name</label>
                                <input type="text" class="form-control" id="CategoryName"
                                    value="{{ $category->name }}" name="name" required>
                            </div>

                            <!-- Submit Button -->
                            <button type="button" class="btn btn-primary text-dark" data-id="{{ $category->id }}"onclick="submitupdatecategoryForm({{ $category->id }})">Update
                                Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
@endsection
