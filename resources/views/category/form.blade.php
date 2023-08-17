<form id="categoryForm" enctype="multipart/form-data">
        @csrf
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@empty($view) @isset($category) Edit @else Add @endisset @else View @endempty Category</h5>
                    <a href="" class="close" data-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body" id="category_form">
            <div class="form-group">
            <label class="form-label required" for="name">Category Name</label>
            <div class="form-control-wrap">
                <input type="text" class="form-control" value="@isset($category){{ $category->name }}@endisset" name="name" required>
            </div>
        </div>
        @empty($view)
        <div class="form-group">
            <button type="button" class="btn btn-primary text-dark" onclick="@isset($category)submitupdatecategoryForm({{ $category->id }}) @else submitcategoryForm()  @endisset">
                Submit</button>
        </div>
        @endempty
        </div>
            </div>
        </div>
    </div>
    </form>
