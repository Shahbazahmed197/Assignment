<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="imageModelLabel">Upload Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <!-- Dropzone for multiple image uploads -->
        <form action="{{ route('picture.update') }}" enctype="multipart/form-data" method="POST" id="profileImageForm">
            @csrf
            <div class="form-group">
                <label for="profileImage">Profile Image</label>
                <input type="file" class="form-control" id="productName" name="image" required
                    placeholder="upload file">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="change-profile-image" type="button" class="btn btn-primary">Upload
        </button>
    </div>
</div><!-- .modal-content -->
@push('scripts')
    <script>
        // Listen for the submit button click event

    </script>
@endpush
