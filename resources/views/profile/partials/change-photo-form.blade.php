<form method="post" enctype="multipart/form-data" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div class="upload-zone" data-accepted-files="image/*">

        <div class="dz-message" data-dz-message>
            <span class="dz-message-text">Drag and drop file</span>
            <span class="dz-message-or">or</span>
            <button type="button" class="btn btn-primary">SELECT</button>
        </div>
    </div>

    <div class="form-group">
        <button type="submit" id="change-profile-image" class="btn btn-lg btn-primary">Submit</button>
    </div>
    <div class="flex items-center gap-4">
        @if (session('status') === 'profile-updated')
            <p
                x-data="{ show: true }"
                x-show="show"
                x-transition
                x-init="setTimeout(() => show = false, 2000)"
                class="text-sm text-gray-600 dark:text-gray-400"
            >{{ __('Saved.') }}</p>
        @endif
    </div>
</form>
<script>
   // Listen for the submit button click event
   $('#change-profile-image').on('click', function() {
        // Manually process the Dropzone queue
        myDropzone.processQueue();
        console.log("addedgile",myDropzone);
    });
    // Listen for the queuecomplete event (all files uploaded)
    myDropzone.on('queuecomplete', function() {
        // Get the added file
        var addedFile = myDropzone.files[0];
        console.log("addedgile",addedFile);
        // Create a FormData object and append the file to it
        var formData = new FormData();
        formData.append('profile_image', addedFile);

        // Send the AJAX request
        $.ajax({
            method: 'POST',
            url: '{{ route('profile.update', ['profile' => 'me']) }}',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    console.log(123);
                    // Update the image on success
                    // You might need to adjust the image URL based on your data
                    // var newImageUrl = response.image_url;
                    // document.getElementById('profileImage').src = newImageUrl;
                } else {
                    // Handle error case
                    console.error('Image update failed.');
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                console.error('AJAX request error:', error);
            }
        });
    });
</script>
