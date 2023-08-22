<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                @empty($view) @isset($product)
                Edit
                 @else
                Add
                 @endisset
                @else
                View @endempty Product
            </h5>
            <a href="/products" class="close" data-dismiss="modal" aria-label="Close">
                <em class="icon ni ni-cross"></em>
            </a>
        </div>
        <div class="modal-body">
                <form enctype="multipart/form-data" @isset($product) id="productupdateForm" @else id="productForm" @endisset class="form-validate is-alter">
                @csrf
                @isset($product)
        @method('PUT')
    @endisset
                 <!-- Product Name -->
        <div class="form-group">
            <label for="productName">Product Name</label>
            <input type="text" class="form-control"value="@isset($product){{ $product->name }}@endisset"
                id="productName" name="name" required placeholder="Enter Product Name">
            @isset($product)
                <input type="text" value="{{ $product->id }}" class="form-control" id="productid"
                    name="product_id" hidden required>
            @endisset
        </div>
                 <!-- Product Description -->
        <div class="form-group">
            <label for="productDescription">Product Description</label>
                        <div class="form-control-wrap">
                <textarea class="form-control no-resize" name="description"  id="default-textarea"> @isset($product) {{$product->description}}@endisset</textarea>
            </div>
        </div>
             <!-- Product Categories (Multiple Select) -->
        @isset($view)
        <div class="form-group">
            <label for="productCategories">Product Categories</label>
            <input type="text" class="form-control"
                value="@isset($product){{ implode(', ',$product->categories()->pluck('name')->toArray()) }}
                @endisset"
                id="productName" name="categories" required>
        </div>
        @else
        <div class="form-group">
            <label for="productCategories">Categories</label>
            <div class="form-control-wrap">
                <select class="form-select" multiple="multiple" name="categories[]" required
                    id="productCategories" data-placeholder="Select Multiple categories">
                    @foreach ($categories as $category)
                        <option
                            @isset($product_categories) @if (in_array($category->id, $product_categories)) selected @endif @endisset
                            value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endisset

       <!-- Product Images (Multiple Uploads) -->
        <label for="productImages">Product Images</label>
        @empty($view)
            <div class="upload-zone" id="imageDropzone" data-accepted-files="image/*">

                <div class="dz-message" data-dz-message>
                    <span class="dz-message-text">Drag and drop file</span>
                    <span class="dz-message-or">or</span>
                    <button type="button" class="btn btn-primary">SELECT</button>
                </div>
                @isset($product)
                @foreach($product->images as $image)
                <div class="dz-preview dz-processing dz-image-preview">
                    <div class="dz-image">
                        <img data-dz-thumbnail id="{{ $image->id }}" src="{{ asset('storage/' . $image->path) }}">
                    </div>
                    <a class="dz-remove" href="javascript:undefined;" data-dz-remove="">Remove file</a>
                </div>
                @endforeach
                @endisset
            </div>
            @else
            <div id="imagePreview" class="d-flex flex-wrap pt-3">
                @foreach ($product->images as $image)
                    <img src="{{ asset('storage/' . $image->path) }}" class="img-thumbnail mr-2 mb-2"
                        style="max-height: 100px;">
                @endforeach
            </div>
        @endempty
    @empty($view)
        <div class="form-group">
            <button type="button" class="btn btn-primary text-dark submit-btn"
                onclick="@isset($product)updateProductForm({{ $product->id }}) @else createProductForm()  @endisset">
                Submit</button>
        </div>
    @endempty
            </form>
        </div>
    </div>
</div>
