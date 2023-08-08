<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Product') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mt-5">
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
                                <select class="form-control" id="productCategories" name="categories[]" multiple
                                    required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product Images (Multiple Uploads) -->
                            <div class="form-group">
                                <label for="productImages">Product Images</label>
                                <input type="file" class="form-control-file" id="productImages" name="images[]"
                                    multiple accept="image/*" required>
                            </div>

                            <!-- Submit Button -->
                            <button type="button" class="btn btn-primary text-dark" onclick="submitForm()">Add
                                Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            var formData = new FormData(document.getElementById('productForm'));
            // var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var sanctumToken = "12|KSuJHdFRe9V8r92ZLDxIHnk8ZDot9XXz0af2gOu0"
            // Send AJAX request to the controller
            $.ajax({
                url: '{{ route('product.store') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'Authorization': 'Bearer ' + sanctumToken, // Include the Sanctum token as a bearer token
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    // Show success message in the responseMessage div
                    $('#responseMessage').html('<div class="alert alert-success">' + response.message +
                        '</div>');
                        removeMessage('#responseMessage');
                },
                error: function(xhr, status, error) {
                    // Show error message in the responseMessage div
                    $('#responseMessage').html('<div class="alert alert-danger">An error occurred: ' + xhr
                        .responseText + '</div>');
                        removeMessage('#responseMessage');
                }
            });
        }
    </script>
</x-app-layout>
