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
                        <button type="button" class="btn btn-primary" id="add_category_btn">Add Category</button>
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
    <div class="modal fade" tabindex="-1" id="modalForm">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modalContent">

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
                            orderable: false,
                            render: function(data, type, full, meta) {
                                var editUrl = "{{ route('categories.edit', ':id') }}".replace(':id',
                                    data
                                    .id);
                                var deleteUrl = "{{ route('categories.destroy', ':id') }}".replace(
                                    ':id',
                                    data.id);
                                return `
            <button type="button" data-id="${data.id}" class="btn btn-info btn-sm mr-2 view-category">View</button>
              <button type="button" data-id="${data.id}"  class="btn btn-primary btn-sm mr-2 edit-category">Edit</button>
              <button type="button" class="btn btn-danger btn-sm delete-category" data-url="${deleteUrl}">Delete</button>
            `;
                            }
                        }
                        // Define other columns as needed
                    ]
                });

            });
            // To Open Add Category Form
            $(document).on('click', '#add_category_btn', function() {
                axios.get("{{ route('categories.create') }}").then(function(response) {
                    $('#modalForm').html(response.data)
                    $('#modalForm').modal('show');
                }).catch(function(error) {

                })
            })
            // To Open view Product Form
            $(document).on('click', '.view-category', function() {
                var id = $(this).attr('data-id');
                axios.get("{{ route('categories.show', ['category' => ':id']) }}".replace(':id', id)).then(function(
                    response) {
                    $('#modalForm').html(response.data)
                    $('#modalForm').modal('show');
                }).catch(function(error) {

                })
            })
            // To Open Edit Category Form
            $(document).on('click', '.edit-category', function() {
                var id = $(this).attr('data-id');
                axios.get("{{ route('categories.edit', ['category' => ':id']) }}".replace(':id', id)).then(function(
                    response) {
                    $('#modalForm').html(response.data)
                    $('#modalForm').modal('show');
                }).catch(function(error) {

                })
            })
        </script>
    @endpush
@endsection
