<form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modalCreateCategory" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="category-name" class="form-label">Category Name</label>
                                                <input type="text" id="category-name" name="name" class="form-control"
                                                       placeholder="Category name">
                                                <span class="error-notification">
                                            @error('name')
                                                    {{ $message }}
                                                    @enderror
                                        </span>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <p>Category Status </p>
                                            <div class="d-flex gap-2 align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="1"
                                                           name="is_active"
                                                           id="is_active1" checked="">
                                                    <label class="form-check-label" for="is_active1">
                                                        Active
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="0"
                                                           name="is_active"
                                                           id="is_active2">
                                                    <label class="form-check-label" for="is_active2">
                                                        In Active
                                                    </label>
                                                </div>
                                                <span class="error-notification">
                                            @error('is_active')
                                                    {{ $message }}
                                                    @enderror
                                        </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
