@extends('layouts.master')

@section('title')
    Categories
@endsection

@section('content')
    <div class="pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container py-2">
                        <a href="{{ route('categories.create') }}" class="btn btn-primary">Add New Category</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container">
                        <div class="table-responsive py-5">
                        <table class="table" id="categories-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Number Of Products</th>
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
                $('#categories-table').DataTable({
                    serverSide: true,
                    ajax: "{{ route('category.data') }}", // Define your data source URL
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'number_of_products',
                            name: 'number_of_products'
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: null,
                            searchable: false,
                            render: function(data, type, full, meta) {
                                var editUrl = "{{ route('categories.edit', ':id') }}".replace(':id',
                                    data
                                    .id);
                                var deleteUrl = "{{ route('categories.destroy', ':id') }}".replace(
                                    ':id',
                                    data.id);
                                return `
              <a href="${editUrl}" class="btn btn-primary btn-sm mr-2">Edit</a>
              <button type="button" class="btn btn-danger btn-sm text-dark delete-category" data-url="${deleteUrl}">Delete</button>
            `;
                            }
                        }
                        // Define other columns as needed
                    ]
                });

            });
        </script>
    @endpush
@endsection
