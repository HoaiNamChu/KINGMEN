@extends('admin.layouts.main')

@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.attributes.store') }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Add Attribute</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="variant-name" class="form-label text-dark">Attribute
                                            Variant</label>
                                        <input type="text" id="variant-name" name="name" class="form-control"
                                               placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="choices-text-unique-values" class="form-label text-dark">Attribute
                                            Value</label>
                                        <input class="form-control" id="choices-text-unique-values" name="attribute_value" data-choices
                                               data-choices-text-unique-true type="text"/>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="variant-slug" class="form-label text-dark">Slug</label>
                                        <input type="text" id="variant-slug" name="slug" class="form-control"
                                               placeholder="Enter Slug">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control bg-light-subtle" name="description"
                                                  id="description"
                                                  rows="7"
                                                  placeholder="Type description"></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <p>Attribute Status </p>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" name="is_active"
                                                   id="is_active1" checked="">
                                            <label class="form-check-label" for="is_active1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="0" name="is_active"
                                                   id="is_active2">
                                            <label class="form-check-label" for="is_active2">
                                                In Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top">
                            <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
