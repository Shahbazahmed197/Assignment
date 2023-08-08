<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="pt-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">

                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <div id="responseMessage"></div>
                        <table class="table" id="products-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Categories</th>
                                    <th>Created At</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#products-table').DataTable({
                    serverSide: true,
                    ajax: "{{ route('products.data') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'categories',
                            name: 'categories'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: null,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                var editUrl = "{{ route('products.edit', ':id') }}".replace(':id', data
                                    .id);
                                var deleteUrl = "{{ route('product.destroy', ':id') }}".replace(':id',
                                    data.id);
                                return `
              <a href="${editUrl}" class="btn btn-primary btn-sm mr-2">Edit</a>
              <button type="button" class="btn btn-danger btn-sm text-dark delete-product" data-url="${deleteUrl}">Delete</button>
            `;
                            }
                        }
                    ]
                });
                $('#products-table').on('click', '.delete-product', function() {
                    var deleteUrl = $(this).data('url');
                    var sanctumToken = "12|KSuJHdFRe9V8r92ZLDxIHnk8ZDot9XXz0af2gOu0"
                    console.log(deleteUrl);
                    if (confirm('Are you sure you want to delete this product?')) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            headers: {
                                'Authorization': 'Bearer ' +
                                    sanctumToken, // Include the Sanctum token as a bearer token
                            },
                            success: function(response) {
                                $('#responseMessage').html('<div class="alert alert-success">' +
                                    response.message +
                                    '</div>');
                                removeMessage('#responseMessage');
                                // Refresh the DataTable after successful deletion
                                $('#products-table').DataTable().ajax.reload();
                            },
                            error: function(xhr, status, error) {
                                // Handle error if needed
                                $('#responseMessage').html(
                                    '<div class="alert alert-danger">An error occurred: ' + xhr
                                    .responseText + '</div>');
                                removeMessage('#responseMessage');
                                console.error('Error deleting product:', error);
                            }
                        });
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
