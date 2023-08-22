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
                        <button type="button" class="btn btn-primary" id="add_product_btn">Add Product</button>

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
                    processing: true,
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
              <button type="button" data-id="${data.id}" class="btn btn-info btn-sm mr-2 view-product">View</button>
              <button type="button" data-id="${data.id}" class="btn btn-primary btn-sm mr-2 edit-product">Edit</button>
              <button type="button" class="btn btn-danger btn-sm  delete-product" data-url="${deleteUrl}">Delete</button>
            `;
                            }
                        }
                    ]
                });

            });
               // To Open Add Product Form
               var base64Images = [];
               $(document).on('click', '#add_product_btn', function (){
                axios.get("{{ route('products.create') }}").then(function(response) {
                    $('#modalForm').html(response.data)
                $('#modalForm').modal('show');
                NioApp.Select2('.form-select', {
                    placeholder: "Select Categories",
                });
                $('.select2-search__field').width('100%')
                NioApp.Dropzone('.upload-zone', {
                url: "{{ route('images.upload') }}",
                paramName: "images[]",
                autoProcessQueue: false,
                addRemoveLinks: true,
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },

                });

            }).catch(function (error){

            })
        })
               // To Open view Product Form
               $(document).on('click', '.view-product', function (){
            var id = $(this).attr('data-id');
                axios.get("{{ route('products.show', ['product' => ':id']) }}".replace(':id', id)).then(function(response) {
                 $('#modalForm').html(response.data)
                $('#modalForm').modal('show');
            }).catch(function (error){

            })
        })
            // To Open Edit Product Form
        $(document).on('click', '.edit-product', function (){
            var id = $(this).attr('data-id');
                axios.get("{{ route('products.edit', ['product' => ':id']) }}".replace(':id', id)).then(function(response) {
                 $('#modalForm').html(response.data)
                $('#modalForm').modal('show');
                NioApp.Select2('.form-select', {
                    placeholder: "Select Categories",
                });
                NioApp.Dropzone('.upload-zone', {
                url: "{{ route('images.upload') }}",
                paramName: "images",
                addRemoveLinks: true,
                autoProcessQueue: false,
                headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
                });
                $('.select2-search__field').width('100%')
            }).catch(function (error){

            })
        })
        </script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/css/bootstrap-select.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.8.1/js/bootstrap-select.js"></script>

    @endpush
@endsection
