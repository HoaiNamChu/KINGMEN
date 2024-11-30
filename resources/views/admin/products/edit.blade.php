@extends('admin.layouts.main')

@section('link')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

@section('styles')
    <style>
        .variant-data{
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl">

        <form action="{{ route('admin.products.update', $product) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
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
                                        <input type="text" id="product-name" value="{{ $product->name }}" name="name"
                                               class="form-control"
                                               placeholder="Items Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="product-sku" class="form-label">Product SKU</label>
                                        <input type="text" id="product-sku" name="sku"
                                               value="{{ $product->sku }}"
                                               class="form-control"
                                               placeholder="SKU">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="product-slug" class="form-label">Slug</label>
                                        <input type="text" id="product-slug" name="slug"
                                               value="{{ $product->slug }}"
                                               class="form-control"
                                               placeholder="Slug">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <label for="description" class="form-label">Description</label>
                                        <div class="mb-3">
                                            <textarea id="editor" name="description">
                                                {!! $product->description !!}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Product data
                                <span>
                                -
                                <label for="product-type">
                                    <select name="product_type" id="product-type">
                                        <optgroup label="Product Type">
                                            <option value="simple" @selected(!$product->variants->count()) id="simple">Product simple</option>
                                            <option value="variable"
                                                    @selected($product->variants->count()) id="variable">Variable product</option>
                                        </optgroup>
                                    </select>
                                </label>
                                </span>
                            </h4>
                        </div>
                        <div class="card-body p-0">
                            <div class="row">
                                <div class="col-lg-3">
                                    <ul class="list-group list-group-flush ">
                                        <li class="list-group-item product-option" data-bs-toggle="pill" id="general">
                                            General
                                        </li>
                                        <li class="list-group-item product-option" data-bs-toggle="pill" id="inventory">
                                            Inventory
                                        </li>
                                        <li class="list-group-item product-option" data-bs-toggle="pill"
                                            id="attributes">Attributes
                                        </li>
                                        <li class="list-group-item product-option" data-bs-toggle="pill"
                                            id="variations">Variations
                                        </li>
                                    </ul>
                                </div>
                                <!-- end col -->
                                <div class="col-lg-9">
                                    <div class="row pt-3 pb-3" id="general-item">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="product-price-import" class="form-label">Price Import</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20"><i
                                                            class="bx bx-dollar"></i></span>
                                                    <input type="number" name="price_import"
                                                           @if(!$product->variants->count())
                                                               value="{{$product->price}}"
                                                           @endif
                                                           id="product-price-import"
                                                           class="form-control"
                                                           placeholder="000">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="product-price" class="form-label">Price</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20"><i
                                                            class="bx bx-dollar"></i></span>
                                                    <input type="number" name="price"
                                                           @if(!$product->variants->count())
                                                               value="{{$product->price}}"
                                                           @endif
                                                           id="product-price"
                                                           class="form-control"
                                                           placeholder="000">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="product-price-sale" class="form-label">Price Sale</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20"><i
                                                            class="bx bx-dollar"></i></span>
                                                    <input type="number" name="price_sale"
                                                           @if(!$product->variants->count())
                                                               value="{{$product->price_sale}}"
                                                           @endif
                                                           id="product-price-sale"
                                                           class="form-control"
                                                           placeholder="000">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3 pb-3" id="inventory-item">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="product-stock" class="form-label">Stock</label>
                                                <input type="number" id="product-stock" name="quantity"
                                                       @if(!$product->variants->count())
                                                           value="{{ $product->quantity }}"
                                                       @endif
                                                       class="form-control" placeholder="Quantity">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row pt-3 pb-3" id="attributes-item">
                                        <div>
                                            <div class="col-lg-6 mb-3 d-inline-block">
                                                <select id="select-attributes" class="form-select">
                                                    <option value="">Select attributes</option>
                                                    @foreach($attributes as $id => $name)
                                                        <option value="{{ $id }}"
                                                                id="attribute-option-{{ $id }}">{{ $name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <button type="button" id="add-attribute" class="btn btn-sm btn-primary">Add
                                                attribute
                                            </button>
                                            <hr>
                                        </div>
                                        <div>
                                            <div id="product-attributes">

                                            </div>
                                            <div>
                                                <button type="button" class="btn btn-sm btn-primary"
                                                        id="btn-save-attributes">Save attributes
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row pt-3 pb-3" id="variations-item">
                                        @foreach($product->variants as $productVariant)
                                            <div class="pe-4" id="variant-{{ $productVariant->id }}">
                                                <div class="align-items-center variant-zone" id="variant-zone-{{ $productVariant->id }}">
                                                    @foreach($productVariant->attributeValues as $item)
                                                        <h5 class="d-inline-block mb-0 me-3">{{ $item->name }}</h5>
                                                    @endforeach
                                                    <button class="btn btn-sm btn-danger float-end btn-remove-variant"
                                                            id="{{ $productVariant->id }}"
                                                            type="button">Remove
                                                    </button>
                                                    <hr>
                                                </div>
                                                <div  class="variant-data" id="variant-data-{{ $productVariant->id }}">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                       for="variant-sku[{{ $productVariant->id }}]">SKU</label>
                                                                <input type="text" class="form-control"
                                                                       id="variant-sku[{{ $productVariant->id }}]"
                                                                       name="product_variants[{{ $productVariant->id }}][sku]"
                                                                       placeholder="Enter SKU"
                                                                       value="{{ $productVariant->sku }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label"
                                                                       for="variant-image[{{ $productVariant->id }}]">Image</label>
                                                                <input type="file" class="form-control"
                                                                       name="product_variants[{{ $productVariant->id }}][image]"
                                                                       id="variant-image[{{ $productVariant->id }}]"
                                                                       placeholder="Enter manufacturer brand">
                                                                @if($productVariant->image)
                                                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($productVariant->image) }}" alt="image" class="img-fluid avatar-xl rounded" />
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end row -->

                                                    <div class="row">
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="variant-quantity[{{ $productVariant->id }}]"
                                                                       class="form-label">Stock</label>
                                                                <input type="number"
                                                                       id="variant-quantity[{{ $productVariant->id }}]"
                                                                       name="product_variants[{{ $productVariant->id }}][quantity]"
                                                                       class="form-control" value="{{ $productVariant->quantity }}" placeholder="Quantity">
                                                                {{--                        <label class="form-label" for="variant-quantity[{{ $productVariant->id }}]">Quantity</label>--}}
                                                                {{--                        <input type="text" class="form-control" id="variant-quantity[{{ $productVariant->id }}]"--}}
                                                                {{--                               placeholder="Stocks"--}}
                                                                {{--                               name="product_variants[{{ $productVariant->id }}][variant_quantity]">--}}
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="variant-price[{{ $productVariant->id }}]"
                                                                       class="form-label">Price</label>
                                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20"><i
                                                            class="bx bx-dollar"></i></span>
                                                                    <input type="number"
                                                                           id="variant-price[{{ $productVariant->id }}]"
                                                                           value="{{ $productVariant->price }}"
                                                                           name="product_variants[{{ $productVariant->id }}][price]"
                                                                           class="form-control"
                                                                           placeholder="000">
                                                                </div>
                                                                {{--                        <label class="form-label" for="variant-price[{{ $productVariant->id }}]">Price</label>--}}
                                                                {{--                        <div class="input-group has-validation mb-3">--}}
                                                                {{--                            <span class="input-group-text" id="variant-price-addon">$</span>--}}
                                                                {{--                            <input type="text" class="form-control" id="variant-price[{{ $productVariant->id }}]"--}}
                                                                {{--                                   name="product_variants[{{ $productVariant->id }}][variant_price]"--}}
                                                                {{--                                   placeholder="Enter price" aria-label="Price"--}}
                                                                {{--                                   aria-describedby="product-price-addon">--}}
                                                                {{--                        </div>--}}

                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <div class="mb-3">
                                                                <label
                                                                    for="variant-price-sale[{{ $productVariant->id }}]"
                                                                    class="form-label">Price Sale</label>
                                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20"><i
                                                            class="bx bx-dollar"></i></span>
                                                                    <input type="number"
                                                                           id="variant-price-sale[{{ $productVariant->id }}]"
                                                                           value="{{ $productVariant->price_sale }}"
                                                                           name="product_variants[{{ $productVariant->id }}][price_sale]"
                                                                           class="form-control"
                                                                           placeholder="000">
                                                                </div>
                                                                {{--                        <label class="form-label" for="variant-price-sale[{{ $productVariant->id }}]">Price--}}
                                                                {{--                            Sale</label>--}}
                                                                {{--                        <div class="input-group mb-3">--}}
                                                                {{--                                                        <span class="input-group-text"--}}
                                                                {{--                                                              id="variant-price-sale-addon">$</span>--}}
                                                                {{--                            <input type="text" class="form-control"--}}
                                                                {{--                                   id="variant-price-sale[{{ $productVariant->id }}]"--}}
                                                                {{--                                   name="product_variants[{{ $productVariant->id }}][variant_price_sale]"--}}
                                                                {{--                                   placeholder="Enter discount" aria-label="discount"--}}
                                                                {{--                                   aria-describedby="product-discount-addon">--}}
                                                                {{--                        </div>--}}
                                                            </div>
                                                        </div>
                                                        <!-- end col -->
                                                    </div>
                                                    <!-- end row -->
                                                    <hr>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Short Description</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                    <textarea class="form-control bg-light-subtle" name="short_desc"
                                              id="short-description" rows="7"
                                              placeholder="Short description about the product">{{ $product->short_desc }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Publish</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_active" type="checkbox" role="switch"
                                       id="is-active" value="1" @checked($product->is_active)>
                                <label class="form-check-label" for="is-active">Is Active</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_featured" type="checkbox" role="switch"
                                       id="is-featured" value="1" @checked($product->is_featured)>
                                <label class="form-check-label" for="is-featured">Is Featured</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_new" type="checkbox" role="switch"
                                       id="is-new" value="1" @checked($product->is_new)>
                                <label class="form-check-label" for="is-new">Is New</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" @checked($product->is_hot) name="is_hot" value="1"
                                       type="checkbox" role="switch" id="is-hot">
                                <label class="form-check-label" for="is-hot">Is Hot</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" @checked($product->is_sale) name="is_sale" value="1"
                                       type="checkbox" role="switch"
                                       id="is-sale">
                                <label class="form-check-label" for="is-sale">Is Sale</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" @checked($product->is_best_seller) name="is_best_seller" value="1"
                                       type="checkbox" role="switch"
                                       id="is-best-seller">
                                <label class="form-check-label" for="is-best-seller">Is Best Seller</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" @checked($product->is_home) name="is_home" value="1"
                                       type="checkbox" role="switch"
                                       id="is-home" checked>
                                <label class="form-check-label" for="is-home">Is Home</label>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Image</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <input type="file" name="image" id="product-image" class="form-control">
                                    </div>
                                    <img src="{{ \Illuminate\Support\Facades\Storage::url($product->image) }}" alt="image" class="img-fluid avatar-xl rounded" />
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Gallery</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <input type="file" name="galleries[]" id="product-image" multiple
                                               class="form-control">
                                    </div>
                                    @if($product->galleries->count())
                                        @foreach($product->galleries as $gallery)
                                            <img src="{{ \Illuminate\Support\Facades\Storage::url($gallery->image) }}" alt="image" class="img-fluid avatar-xl rounded" />
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-inline-block">Product Categories</h4>
                        </div>
                        <div class="card-body">
                            <div class="border" style="padding: 5px 10px; max-height: 200px; overflow: scroll;">
                                @foreach($categories as $item)
                                    @php
                                        $marginLeft = 0;
                                    @endphp
                                    @include('admin.products.components.edit-category', ['category'=>$item, 'marginLeft'=>$marginLeft, 'product' => $product])
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Product Brands</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <select class="form-control" id="product-brand" data-choices
                                            data-choices-groups data-placeholder="Select Brands"
                                            name="brand_id">
                                        <option value="">Choose a brand</option>
                                        @foreach($brands as $id => $name)
                                            <option
                                                value="{{ $id }}" @selected($product->brand_id == $id)>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tags</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <select class="form-control" id="choices-multiple-remove-button" data-choices
                                            data-choices-removeItem name="tags[]" multiple>
                                        @foreach($tags as $id => $name)
                                            <option
                                                value="{{ $id }}" @selected(in_array($id, $product->tags->pluck('id')->toArray()))>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-center g-2">
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-outline-secondary w-100">Update Product</button>
                            </div>
                            <div class="col-lg-5">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
    @include('admin.products.modals.create-category')
@endsection


@section('lib-script')
    <script src="{{ asset('theme/admin/assets/js/components/form-quilljs.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ asset('theme/admin/assets/vendor/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                window.editor = editor;
            } )
            .catch( error => {
                console.error( 'There was a problem initializing the editor.', error );
            } );
    </script>
    <script>


        $(document).ready(function () {

            var productType = $('#product-type option:selected');

            if (productType.val() === 'simple') {
                $('#variations, #attributes, #inventory-item, #attributes-item, #variations-item').hide();
                $('#general, #inventory, #general-item').show();
            }
            if (productType.val() === 'variable') {
                $('#variations, #attributes, #variations-item').show();
                $('#general, #inventory, #general-item, #inventory-item, #attributes-item').hide();
            }
            $('.product-option').click(function () {
                var selectedId = $(this).attr('id');
                $('#general-item, #inventory-item, #attributes-item, #variations-item').hide();
                $('#' + selectedId + '-item').show();
            });

            $('#product-type').change(function () {
                var productType = $('#product-type option:selected');
                if (productType.val() === 'simple') {
                    $('#variations, #attributes, #inventory-item, #attributes-item, #variations-item').hide();
                    $('#general, #inventory, #general-item').show();
                }
                if (productType.val() === 'variable') {
                    $('#variations, #attributes, #attributes-item').show();
                    $('#general, #inventory, #general-item, #inventory-item, #variations-item').hide();
                }
            })


            $('#add-attribute').click(function () {
                var attribute = $('#select-attributes option:selected').val();
                // var productAttributesHtml = ``
                if (attribute && $('#block-attribute-' + attribute).length === 0) {
                    $.ajax({
                        url: `{{ route('addAttribute') }}`,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            attribute_id: attribute
                        },
                        success: function (response) {
                            var attributeValueHtml = '';
                            response.attribute.attribute_values.forEach(function (attributeValue) {
                                attributeValueHtml += '<option value="' + attributeValue.id + '">' + attributeValue.name + '</option>';
                            });
                            var attributeHtml = `<div id="block-attribute-${response.attribute.id}" class="block-attributes">
                                <h4 class="d-inline-block">${response.attribute.name}</h4>
                            <button type="button" class="btn btn-sm btn-danger float-end btn-remove-attribute"
                                    id="btn-remove-${response.attribute.id}">
                                Remmove
                            </button>
                            <hr>
                                <div>
                                    <table style="width: 100%;">
                                        <thead>
                                        <tr>
                                            <th style="width: 30%;">Name:</th>
                                            <th style="width: 70%;">Values:</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <strong>${response.attribute.name}</strong>
                                            </td>
                                            <td>
                                                <select id="select-${response.attribute.id}" style="width: 100%" multiple>
                                                     ${attributeValueHtml}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            </td>
                                            <td>
                                                <button type="button"
                                                        class="btn btn-sm btn-primary btn-selectAll-attribute float-start"
                                                        id="btn-selectAll-${response.attribute.id}">Select
                                                    all
                                                </button>
                                                <button type="button"
                                                        class="btn btn-sm btn-warning btn-selectNone-attribute float-start"
                                                        id="btn-selectNone-${response.attribute.id}">Select
                                                    none
                                                </button>
                                                <button type="button"
                                                        class="btn btn-sm btn-primary btn-create-attribute float-end"
                                                        id="btn-create-${response.attribute.id}">
                                                    Create
                                                    value
                                                </button>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                </div>
                                `;
                            $('#product-attributes').append(attributeHtml);
                            $('#attribute-option-' + attribute).prop('selected', false).prop('disabled', true);
                        },
                        error: function (xhr, status, error) {

                        }

                    });
                }

            });

        });
        $(document).on('click', '#btn-save-attributes', function () {
            if ($('#product-attributes').html().trim().length === 0) {
                console.log('No data');
            } else {
                var attributeValueIds = [];
                var attributeIds = [];
                $('.block-attributes').each(function () {
                    var arrId = $(this).attr('id').split('-');
                    attributeIds.push(arrId[2]);
                    $('#select-' + arrId[2] + ' option:selected').each(function () {
                        attributeValueIds.push($(this).val());
                    });
                });
                $('#variations-item').innerHTML = '';
                $.ajax({
                    url: '/api/addAttributeValue',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        attributeIds: attributeIds,
                        attributeValueIds: attributeValueIds
                    },
                    success: function (response) {
                        $('#variations-item').append(response);
                    },
                    error: function (response) {

                    }
                });

            }
        });

        $(document).on('click', '.btn-remove-variant', function () {
            var btnId = $(this).attr('id');
            $('#variant-' + btnId).remove();
        });

        $(document).on('click', '.btn-remove-attribute', function () {
            var btnId = $(this).attr('id').split('-');
            var attributeId = btnId[2]
            $('#block-attribute-' + attributeId).remove();
            $('#attribute-option-' + attributeId).prop('disabled', false)
        });


        $(document).on('click', '.btn-selectAll-attribute', function () {
            var btnId = $(this).attr('id').split('-');
            var attributeId = btnId[2]
            $('#select-' + attributeId + ' option').prop('selected', true);
        });


        $(document).on('click', '.btn-selectNone-attribute', function () {
            var btnId = $(this).attr('id').split('-');
            var attributeId = btnId[2]
            console.log(attributeId);
            $('#select-' + attributeId + ' option').prop('selected', false);
        });

        $(document).on('click', '.variant-zone', function () {
            var variantID = $(this).attr('id').split('variant-zone-');
            var isHidden = $('#variant-data-'+ variantID[1]).is(":hidden");
            if (isHidden) {
                $('#variant-data-'+ variantID[1]).show();
            } else {
                $('#variant-data-'+ variantID[1]).hide();
            }
        });

        @if(session('success'))
        Toastify({

            text: "{{ session('success') }}",

            duration: 3000,

            gravity: top,

            close: true,

        }).showToast();
        @endif

        @if(session('error'))
        Toastify({

            text: "{{ session('error') }}",

            duration: 3000,

            gravity: top,

            close: true,

            className: "bg-danger",

        }).showToast();
        @endif
    </script>
@endsection
