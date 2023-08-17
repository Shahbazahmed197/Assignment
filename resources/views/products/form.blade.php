<form enctype="multipart/form-data"
    @isset($product)
id="productupdateForm" @else id="productForm" @endisset>
    @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@empty($view) @isset($product) Edit @else Add @endisset @else View @endempty Product</h5>

                <a href="" class="close" data-dismiss="modal" aria-label="Close">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body" id="product_form">
                <!-- Product Name -->
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control"
                        value="@isset($product){{ $product->name }}
                    @endisset"
                        id="productName" name="name" required>
                    @isset($product)
                        <input type="text" value="{{ $product->id }}" class="form-control" id="productid"
                            name="product_id" hidden required>
                    @endisset
                </div>

                <!-- Product Description -->
                <div class="form-group ">
                    <label for="productDescription">Product Description</label>
                    <textarea class="form-control" id="productDescription" name="description" rows="4" required>
                        @isset($product)
                        {{ trim($product->description) }}
                        @endisset
                    </textarea>
                </div>

                <!-- Product Categories (Multiple Select) -->
                @isset($view)
                <div class="form-group">
                    <label for="productCategories">Product Categories</label>
                    <input type="text" class="form-control"
                        value="@isset($product){{ implode(', ', $product->categories()->pluck('name')->toArray())}}
                    @endisset"
                        id="productName" name="categories" required>
                </div>
                @else
                <div class="form-group">
                    <label for="productCategories">Categories</label>
                    <div class="form-control-select-multiple">

                        <select class="selectpicker form-control" data-live-search="true" id="productCategories"
                            name="categories[]" multiple required>
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
                <div class="form-group">
                    <label for="productImages">Product Images</label>
                    @empty($view)
                    <input type="file" class="form-control-file" id="productImages" name="images[]" multiple
                        accept="image/*" required>
                        @endempty
                    @isset($product)
                        <div id="imagePreview" class="d-flex flex-wrap pt-3">
                            @foreach ($product->images as $image)
                                <img src="{{ asset('storage/' . $image->path) }}" class="img-thumbnail mr-2 mb-2"
                                    style="max-height: 100px;">
                            @endforeach
                        </div>
                    @endisset
                </div>
                @empty($view)
                <div class="form-group">
                    <button type="button" class="btn btn-primary text-dark"
                        onclick="@isset($product)updateProductForm() @else createProductForm()  @endisset">
                        Submit</button>
                </div>
                @endempty
            </div>
        </div>
    </div>
    </div>
</form>
