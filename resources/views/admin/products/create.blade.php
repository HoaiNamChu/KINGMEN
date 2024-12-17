@extends('admin.layouts.main')

@section('links')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

@section('styles')
    <style>
        .variant-data {
            display: none;
        }
        .ck-editor__editable_inline {
            height: 300px;
        }
    </style>
@endsection


@section('content')
    <div class="container-xxl">

        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
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
                                        <input type="text" id="product-name" name="name"
                                               class="form-control @error('name') border-danger @enderror"
                                               value="{{ old('name') }}"
                                               placeholder="Items Name">
                                        <span class="error-notification">
                                        @error('name')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="product-sku" class="form-label">Product SKU</label>
                                        <input type="text" id="product-sku" name="sku"
                                               value="{{ \Illuminate\Support\Str::random(8) }}"
                                               class="form-control @error('sku') border-danger @enderror"
                                               placeholder="SKU">
                                        <span class="error-notification">
                                        @error('sku')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <label for="description" class="form-label">Description</label>
                                        <div class="mb-3">
                                            <textarea id="editor" name="description">
                                                {!! old('description') !!}
                                            </textarea>
                                            <span class="error-notification">
                                            @error('description')
                                            {{ $message }}
                                            @enderror
                                            </span>
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
                                            <option value="simple" selected id="simple">Product simple</option>
                                            <option value="variable" id="variable">Variable product</option>
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
                                                <label for="product-price-import" class="form-label">Price
                                                    Import</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20"><i
                                                                class="bx bx-dollar"></i></span>
                                                    <input type="number" name="price_import" id="product-price-import"
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
                                                    <input type="number" name="price" id="product-price"
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
                                                    <input type="number" name="price_sale" id="product-price-sale"
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
                                              placeholder="Short description about the product">
                                        {!! old('short_desc') !!}
                                    </textarea>
                                        <span class="error-notification">
                                        @error('short_desc')
                                        {{ $message }}
                                        @enderror
                                        </span>
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
                                       id="is-active" value="1" checked>
                                <label class="form-check-label" for="is-active">Is Active</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_new" type="checkbox" role="switch"
                                       id="is-new" value="1">
                                <label class="form-check-label" for="is-new">Is New</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_featured" type="checkbox" role="switch"
                                       id="is-featured" value="1">
                                <label class="form-check-label" for="is-featured">Is Featured</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_hot" value="1" type="checkbox" role="switch"
                                       id="is-hot">
                                <label class="form-check-label" for="is-hot">Is Hot</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_sale" value="1" type="checkbox" role="switch"
                                       id="is-sale">
                                <label class="form-check-label" for="is-sale">Is Sale</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_best_seller" value="1" type="checkbox"
                                       role="switch"
                                       id="is-best-seller">
                                <label class="form-check-label" for="is-best-seller">Is Best Seller</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_home" value="1" type="checkbox" role="switch"
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
                                        <input type="file" name="image" id="product-image" class="form-control @error('image') border-danger @enderror">
                                        <span class="error-notification">
                                        @error('image')
                                        {{ $message }}
                                        @enderror
                                        </span>
                                    </div>
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
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-inline-block">Product Categories</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2">Select product category</p>
                            <div class="border" style="padding: 5px 10px; max-height: 200px; overflow: scroll;">
                                @foreach($categories as $item)
                                    @php
                                        $marginLeft = 0;
                                    @endphp
                                    @include('admin.products.components.create-category', ['category'=>$item, 'marginLeft'=>$marginLeft])
                                @endforeach
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-inline-block">Product Brands</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <select class="form-control" id="product-brand" data-choices
                                            data-choices-groups data-placeholder="Select Brands"
                                            name="brand_id">
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
                            <h4 class="card-title d-inline-block">Tags</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <select class="form-control" id="choices-multiple-remove-button" data-choices
                                            data-choices-removeItem name="tags[]" multiple>
                                        @foreach($tags as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-center g-2">
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-outline-secondary w-100">Create Product</button>
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
    {{--    <script src="{{ asset('theme/admin/assets/js/components/form-quilljs.js') }}"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{{ asset('theme/admin/assets/vendor/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '{{route('admin.ckeditor.uploads',['_token'=>csrf_token()])}}'
                }
            })
            .catch(error => {
                console.error('There was a problem initializing the editor.', error);
            });
    </script>
    <script>


        $(document).ready(function () {

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

            var productType = $('#product-type option:selected');
            if (productType.val() === 'simple') {
                $('#variations, #attributes').hide();
                $('#general, #inventory').show();
            }
            if (productType.val() === 'variable') {
                $('#variations, #attributes').show();
                $('#general, #inventory').hide();
            }

            $('#inventory-item, #attributes-item, #variations-item').hide();
            $('.product-option').click(function () {
                var selectedId = $(this).attr('id');
                $('#general-item, #inventory-item, #attributes-item, #variations-item').hide();
                $('#' + selectedId + '-item').show();
            });


            $('#product-type').change(function () {
                var productType = $('#product-type option:selected');
                if (productType.val() === 'simple') {
                    $('#variations, #attributes').hide();
                    $('#general, #inventory').show();
                }
                if (productType.val() === 'variable') {
                    $('#variations, #attributes').show();
                    $('#general, #inventory').hide();
                }
            });


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
                $.ajax({
                    url: '/api/addAttributeValue',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        attributeIds: attributeIds,
                        attributeValueIds: attributeValueIds
                    },
                    success: function (response) {

                        // var attributes = response.attributes
                        //
                        // function variants(attributes){
                        //     for (i = 0; i < attributes.length; i++) {
                        //         for (j = 0; j < attributes[i].attribute_values.length; j++) {
                        //             arrs.push(attributes[i].attribute_values[j])
                        //         }
                        //     }
                        // }
                        //
                        // var vairants1 = variants(attributes)
                        //
                        // console.log(vairants1)


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
            var isHidden = $('#variant-data-' + variantID[1]).is(":hidden");
            if (isHidden) {
                $('#variant-data-' + variantID[1]).show();
            } else {
                $('#variant-data-' + variantID[1]).hide();
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
    </script>
@endsection
