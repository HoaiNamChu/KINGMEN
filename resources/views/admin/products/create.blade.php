@extends('admin.layouts.main')

@section('link')

@endsection

@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-9 col-lg-8 ">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Product Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="product-name" class="form-label">Product Name</label>
                                    <input type="text" id="product-name" class="form-control"
                                           placeholder="Items Name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-3">
                                    <label for="product-sku" class="form-label">Product SKU</label>
                                    <input type="text" id="product-sku" value="{{ \Illuminate\Support\Str::random(8) }}"
                                           class="form-control"
                                           placeholder="SKU">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <label for="description" class="form-label">Description</label>
                                    <div class="mb-3">
                                        <div id="snow-editor"  style="height: 300px;">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Pricing Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <form>
                                    <label for="product-price" class="form-label">Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><i class='bx bx-dollar'></i></span>
                                        <input type="number" id="product-price" class="form-control"
                                               placeholder="000">
                                    </div>
                                </form>
                            </div>
                            <div class="col-lg-4">
                                <form>
                                    <label for="product-discount" class="form-label">Discount</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><i class='bx bxs-discount'></i></span>
                                        <input type="number" id="product-discount" class="form-control"
                                               placeholder="000">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        Short Description
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <textarea class="form-control bg-light-subtle" id="short-description" rows="7"
                                              placeholder="Short description about the product"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-light mb-3 rounded">
                    <div class="row justify-content-end g-2">
                        <div class="col-lg-2">
                            <a href="#!" class="btn btn-outline-secondary w-100">Create Product</a>
                        </div>
                        <div class="col-lg-2">
                            <a href="#!" class="btn btn-primary w-100">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-header">
                        Publish
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is-active" checked>
                            <label class="form-check-label" for="is-active">Is Active</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is-hot">
                            <label class="form-check-label" for="is-hot">Is Hot</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is-sale">
                            <label class="form-check-label" for="is-sale">Is Sale</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="is-home" checked>
                            <label class="form-check-label" for="is-home">Is Home</label>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Product Image
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <input type="file" id="product-image" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Product Gallery
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div>
                                    <input type="file" id="product-image" multiple class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Product Categories
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <select class="form-control" id="product-categories" data-choices
                                        data-choices-groups data-placeholder="Select Categories"
                                        name="choices-single-groups">
                                    <option value="">Choose a categories</option>
                                    @foreach($categories as $item)
                                        @php
                                            $dash = ' ';
                                        @endphp
                                        @include('components.admin.categories.create', ['item'=>$item, 'dash' => $dash])
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>\
                <div class="card">
                    <div class="card-header">
                        Product Brands
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <select class="form-control" id="product-brand" data-choices
                                        data-choices-groups data-placeholder="Select Brands"
                                        name="choices-single-groups">
                                    <option value="">Choose a brand</option>
                                    @foreach($brands as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        Tags
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <select class="form-control" id="choices-multiple-remove-button" data-choices
                                        data-choices-removeItem name="choices-multiple-remove-button" multiple>
                                    @foreach($tags as $id => $name)
                                        <option value="{{ $id }}">{{ $name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection


@section('lib-script')
        <script src="{{ asset('theme/admin/assets/js/components/form-quilljs.js') }}"></script>
@endsection

@section('script')

@endsection
