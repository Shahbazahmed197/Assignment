const Toast = Swal.mixin({
    toast: true,
    position: 'top-right',
    iconColor: 'white',
    customClass: {
      popup: 'colored-toast'
    },
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true
  })

  //fucntions related to category

  //add category
        function submitcategoryForm() {
            var formData = new FormData(document.getElementById('categoryForm'));
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Send AJAX request to the controller
            $.ajax({
                url: '/categories',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    $('input[name="name"]').val('');
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })
                    setTimeout(function() {
                        window.location.href = '/category';
                    }, 1000);
                },
                error: function(xhr, status, error,response) {
                    // Show error message in the responseMessage div
                    Toast.fire({
                        icon: 'error',
                        title: xhr.responseJSON.message
                    })
                }
            });
        }


        //delete category
        $('#categories-table').on('click', '.delete-category', function() {
            var deleteUrl = $(this).data('url');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // You can add a confirmation modal here if needed
            Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this category!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then(function (result) {
        if (result.isConfirmed) {
                // Perform AJAX delete request
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Refresh the DataTable after successful deletion
                        $('#categories-table').DataTable().ajax.reload();
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        })
                    },
                    error: function(xhr, status, error) {
                        Toast.fire({
                            icon: 'error',
                            title: xhr.responseJSON.message
                        })
                        console.error('Error deleting product:', error);
                    }
                });
            }
        });
        });


        //update category
        function submitupdatecategoryForm(itemId) {
            var formData = {
                name: $("input[name='name']").val(),
            };
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/categories/' + itemId,
                type: 'PUT',
                data: JSON.stringify(formData),
                headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json'
                            },
                contentType: false,
                processData: false,
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })
                    setTimeout(function() {
                        window.location.href = '/category';
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    Toast.fire({
                        icon: 'error',
                        title: xhr.responseJSON.message
                    })
                }
            });
        }

        // add new product
        function createProductForm() {
            var formData = new FormData(document.getElementById('productForm'));
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // var sanctumToken = "12|KSuJHdFRe9V8r92ZLDxIHnk8ZDot9XXz0af2gOu0"
            // Send AJAX request to the controller
            $.ajax({
                url: '/products',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    $('input[type="text"]').val(''); // This will clear all text input fields
                    $('input[type="file"]').val(''); // This will clear all file input fields
                    Toast.fire({
                            icon: 'success',
                            title: response.message
                        })
                        setTimeout(function() {
                            window.location.href = '/product';
                        }, 1000);
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) { // HTTP status code for validation errors
                        var errors = xhr.responseJSON.errors;
                        // Loop through each field's error messages
                        for (var field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                var errorMessage = errors[field][0];
                                Toast.fire({
                            icon: 'error',
                            title: errorMessage
                        })
                            }
                        }
                    }
                }
            });
        }

        //update product
        function updateProductForm() {
             var formData = new FormData(document.getElementById('productupdateForm'));
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/update-product',
                type: 'POST',
                data:formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    Toast.fire({
                        icon: 'success',
                        title: response.message
                    })
                    setTimeout(function() {
                        window.location.href = '/product';
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) { // HTTP status code for validation errors
                        var errors = xhr.responseJSON.errors;
                        // Loop through each field's error messages
                        for (var field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                var errorMessage = errors[field][0];
                                Toast.fire({
                            icon: 'error',
                            title: errorMessage
                        })
                            }
                        }
                    }
                }
            });
        }

        //delete product
        $('#products-table').on('click', '.delete-product', function() {
            var deleteUrl = $(this).data('url');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            console.log(deleteUrl);
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this product!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function (result) {
                if (result.isConfirmed) {
                $.ajax({
                    url: deleteUrl,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        // Refresh the DataTable after successful deletion
                        $('#products-table').DataTable().ajax.reload();
                        Toast.fire({
                            icon: 'success',
                            title: response.message
                        })
                    },
                    error: function(xhr, status, error) {
                        // Handle error if needed
                        Toast.fire({
                            icon: 'error',
                            title: xhr.responseJSON.message
                        })
                    }
                });
            }
        });
        });
