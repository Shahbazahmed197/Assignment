<x-app-layout>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Category') }}
        </h2>
    </x-slot>
    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mt-5">
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
                            <button type="button" class="btn btn-primary text-dark" onclick="submitForm()">Update
                                Category</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            var formData = {
                name: $("input[name='name']").val(),
            };
            console.log(formData);
            // var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var sanctumToken = "12|KSuJHdFRe9V8r92ZLDxIHnk8ZDot9XXz0af2gOu0"
            $.ajax({
                url: '{{ route('category.update', $category->id) }}',
                type: 'PUT',
                data: JSON.stringify(formData),
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
