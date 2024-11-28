<form action="{{ route('admin.attributeValues.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modalCreateAttributeValue" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="attribute_id" value="{{ $attribute->id }}">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="category-name" class="form-label">Attribute Value Name</label>
                                <input type="text" id="category-name" name="name" class="form-control"
                                       placeholder="Attribute value name">
                                <span class="error-notification">
                                            @error('name')
                                    {{ $message }}
                                    @enderror
                                        </span>
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
