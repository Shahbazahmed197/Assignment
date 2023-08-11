@extends('layouts.master')
@section('title')
    Products
@endsection
    @section('content')
    <div class="pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container py-2">
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Add New Product</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="p-4">
                        <div class="table-responsive py-5">
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
                            orderable:false,
                            render: function(data, type, full, meta) {
                                var editUrl = "{{ route('products.edit', ':id') }}".replace(':id', data
                                    .id);
                                var deleteUrl = "{{ route('products.destroy', ':id') }}".replace(':id',
                                    data.id);
                                return `
              <a href="${editUrl}" class="btn btn-primary btn-sm mr-2">Edit</a>
              <button type="button" class="btn btn-danger btn-sm text-dark delete-product" data-url="${deleteUrl}">Delete</button>
            `;
                            }
                        }
                    ]
                });

            });
        </script>
    @endpush
@endsection
