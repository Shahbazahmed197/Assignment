
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@empty($view) @isset($category) Edit @else Add @endisset @else View @endempty Category</h5>
                <a  class="close" data-dismiss="modal" aria-label="Close" href="/categories">
                    <em class="icon ni ni-cross"></em>
                </a>
            </div>
            <div class="modal-body">
                    <form id="categoryForm" class="form-validate is-alter" enctype="multipart/form-data">
                        @csrf
                        {{-- category name --}}
                        <div class="form-group">
                            <label class="form-label required" for="name">Category Name</label>
                            <div class="form-control-wrap">
                                <input type="text" class="form-control" value="@isset($category){{ $category->name }}@endisset" name="name" required>
                            </div>
                        </div>
                    @empty($view)
                    <div class="form-group">
                        <button type="button" class="btn btn-primary text-dark submit-btn" onclick="@isset($category)submitupdatecategoryForm({{ $category->id }}) @else submitcategoryForm()  @endisset">
                            Submit</button>
                    </div>
                    @endempty
                </form>
            </div>
        </div>
    </div>
