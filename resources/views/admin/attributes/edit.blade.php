@extends('admin.layouts.main')

@section('link')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.attributes.update', $attribute) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4 class="card-title">Update Attribute</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="variant-name" class="form-label text-dark">Attribute
                                            Variant</label>
                                        <input type="text" id="variant-name" value="{{ $attribute->name }}" name="name"
                                               class="form-control"
                                               placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="choices-multiple-remove-button" class="form-label text-dark">Attribute
                                            Value</label>

                                        <select class="form-control" id="choices-multiple-remove-button" data-choices data-choices-removeItem name="attribute_value_id[]" multiple>

                                            @if($attribute->attributeValues)
                                                @foreach($attribute->attributeValues as $item)
                                                    <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <span><a href="" class="text-decoration-underline">+ Add attribute value</a></span>
                                    </div>

                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="variant-slug" class="form-label text-dark">Slug</label>
                                        <input type="text" id="variant-slug" value="{{ $attribute->slug }}" name="slug"
                                               class="form-control"
                                               placeholder="Enter Slug">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control bg-light-subtle" name="description"
                                                  id="description"
                                                  rows="7"
                                                  placeholder="Type description">{{ $attribute->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <p>Attribute Status </p>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" name="is_active"
                                                   id="is_active1" @checked($attribute->is_active)>
                                            <label class="form-check-label" for="is_active1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="0" name="is_active"
                                                   id="is_active2" @checked(!$attribute->is_active)>
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

@section('lib-script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
@endsection

@section('script')

    <script>

        @if(session('success'))
        Toastify({

            text: "{{ session('success') }}",

            duration: 3000,

            gravity: top,

            close: true,

        }).showToast();
        @endif

    </script>

@endsection
