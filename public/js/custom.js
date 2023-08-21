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

  const loader = `
    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
    <span> </span>
`;
const submitBtn=$('.submit-btn');
  //fucntions related to category

  //add category
        function submitcategoryForm() {
            var submitBtn = $('.submit-btn');
            submitBtn.prop('disabled', true);
            submitBtn.html(loader);
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
                    NioApp.Toast(response.message, 'success');
                    $('#categories-table').DataTable().ajax.reload();
                    $('#modalForm').modal('hide');
                },
                error: function(xhr, status, error,response) {
                    // Show error message in the responseMessage
                    submitBtn.prop('disabled', false);
                    submitBtn.html('Submit');
                    NioApp.Toast(xhr.responseJSON.message, 'error');
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
                        NioApp.Toast(response.message, 'success');
                        $('#categories-table').DataTable().ajax.reload();
                        $('#modalForm').modal('hide');
                    },
                    error: function(xhr, status, error) {
                        NioApp.Toast(xhr.responseJSON.message, 'error');
                    $('#categories-table').DataTable().ajax.reload();
                    }
                });
            }
        });
        });


        //update category
        function submitupdatecategoryForm(itemId) {
            var submitBtn = $('.submit-btn');
            submitBtn.prop('disabled', true);
            submitBtn.html(loader);
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
                    NioApp.Toast(response.message, 'success');
                    $('#categories-table').DataTable().ajax.reload();
                    $('#modalForm').modal('hide');
                    // Toast.fire({
                    //     icon: 'success',
                    //     title: response.message
                    // })
                },
                error: function(xhr, status, error) {
                    submitBtn.prop('disabled', false);
                    submitBtn.html('Submit');
                    NioApp.Toast(xhr.responseJSON.message, 'error');
                    $('#modalForm').modal('show');
                }
            });
        }

        // add new product
        function createProductForm() {
            var submitBtn = $('.submit-btn');
            submitBtn.prop('disabled', true);
            submitBtn.html(loader);
            var formData = new FormData(document.getElementById('productForm'));
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var imageSrcList = []; // Array to hold the image src attributes

            // Iterate through image previews and extract src attributes
            $('.dz-preview .dz-image img').each(function() {
                var src = $(this).attr('src');
                if (src) {
                    imageSrcList.push(src);
                }
                formData.append('images[]', src);
            });

            // Include imageSrcList array in the form data
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
                    NioApp.Toast(response.message, 'success');
                    $('#products-table').DataTable().ajax.reload();
                    $('#modalForm').modal('hide');
                },
                error: function(xhr, status, error) {
                    submitBtn.prop('disabled', false);
                    submitBtn.html('Submit');
                    if (xhr.status === 422) { // HTTP status code for validation errors
                        var errors = xhr.responseJSON.errors;
                        // Loop through each field's error messages
                        for (var field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                var errorMessage = errors[field][0];
                            }
                        }
                        NioApp.Toast(errorMessage, 'error');
                    }
                }
            });
        }

        //update product
        function updateProductForm(id) {
            var submitBtn = $('.submit-btn');
            submitBtn.prop('disabled', true);
            submitBtn.html(loader);
             var formData = new FormData(document.getElementById('productupdateForm'));
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formDataObject = {};
    formData.forEach(function(value, key) {
        formDataObject[key] = value;
    });
            $.ajax({
                url: '/products/'+id,
                type: 'PUT',
                data: JSON.stringify(formDataObject),
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                },
                processData: false,
                success: function(response) {
                    NioApp.Toast(response.message, 'success');
                    $('#products-table').DataTable().ajax.reload();
                    $('#modalForm').modal('hide');
                },
                error: function(xhr, status, error) {
                    submitBtn.prop('disabled', false);
                    submitBtn.html('Submit');
                    if (xhr.status === 422) { // HTTP status code for validation errors
                        var errors = xhr.responseJSON.errors;
                        // Loop through each field's error messages
                        for (var field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                var errorMessage = errors[field][0];
                            }
                        }
                        NioApp.Toast(errorMessage, 'error');
                    }
                }
            });
        }

        //delete product
        $('#products-table').on('click', '.delete-product', function() {
            var deleteUrl = $(this).data('url');
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
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
                        NioApp.Toast(response.message, 'success');
                        $('#products-table').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error if needed
                        NioApp.Toast(xhr.responseJSON.message, 'error');
                    }
                });
            }
        });
        });


        //add comment
        function submitcommentForm() {
            var formData = new FormData(document.getElementById('commentForm'));
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Send AJAX request to the controller
            $.ajax({
                url: '/comment',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                contentType: false,
                processData: false,
                success: function(response) {
                    $('input[name="rating"]').val('');
                    $('textarea[name="comment"]').val('');
                    NioApp.Toast(response.message, 'success');
                    preAppendNewComment(response);
                },
                error: function(xhr, status, error, response) {
                    // Show error message
                    if(xhr.responseJSON.message==="Unauthenticated."){
                    NioApp.Toast('Please Login to comment', 'error');
                    $('#products-table').DataTable().ajax.reload();
                }else{
                    var errors = xhr.responseJSON.errors;
                        // Loop through each field's error messages
                        for (var field in errors) {
                            if (errors.hasOwnProperty(field)) {
                                var errorMessage = errors[field][0];
                            }
                        }
                        NioApp.Toast(errorMessage, 'error');
                }
                }
            });
        }
        //function to preAppend the added comment on top
        //used in add comment function
        function preAppendNewComment(response){
            const commentContainer = document.getElementById('commentContainer');

            // Create a new comment element and populate it with the comment data
            const newCommentElement = document.createElement('div');
            newCommentElement.className = 'comment py-3';
            newCommentElement.innerHTML = `<span><strong> ${response.data.user_name} &nbsp;</strong></span><span><small>
             ${response.data.updated_at}</small></span>
             <p>${ response.data.rating} Stars</p>
            <p>${response.data.content}</p>`;
             // Create an <hr> element to separate the comments visually
            const hrElement = document.createElement('hr');
            // Append the new comment element to the comment container
            commentContainer.prepend(hrElement);
            commentContainer.prepend(newCommentElement);
        }
//update password
$(document).ready(function() {
    $('#update-password-button').click(function() {
        console.log('Button clicked');
        var submitBtn = $('.submit-btn');
        submitBtn.prop('disabled', true);
        submitBtn.html(loader);
        var formData = new FormData(document.getElementById('updatePasswordForm'));
        var formDataJSON = {};

        formData.forEach(function(value, key) {
            formDataJSON[key] = value;
        });

        var formDataString = JSON.stringify(formDataJSON);
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // Send AJAX request to the controller
        $.ajax({
            url: '/password',
            type: 'PUT',
            data: formDataString,
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },

            processData: false,
            success: function(response) {
                submitBtn.html('Change Password');
                $('input[type="password"]').val('');
                $('#change-password-modal').modal('hide');
                NioApp.Toast(response.message, 'success');
            },
            error: function(xhr, status, error, response) {
                // Show error message in the responseMessage
                submitBtn.prop('disabled', false);
                submitBtn.html('Change Password');
                NioApp.Toast(xhr.responseJSON.message, 'error');
            }
        });
    });
});
