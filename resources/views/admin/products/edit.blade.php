@extends('admin.layouts.main')

@section('link')

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
                                    <div>
                                        <label for="description" class="form-label">Description</label>
                                        <div class="mb-3">
                                            <div id="snow-editor" style="height: 300px;">

                                            </div>
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
                                    <ul class="list-group">
                                        <li class="list-group-item product-option" id="general">General</li>
                                        <li class="list-group-item product-option" id="inventory">Inventory</li>
                                        <li class="list-group-item product-option" id="attributes">Attributes</li>
                                        <li class="list-group-item product-option" id="variations">Variations</li>
                                    </ul>
                                </div>
                                <!-- end col -->
                                <div class="col-lg-9">
                                    <div class="row pt-3 pb-3" id="general-item">
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
                                              placeholder="Short description about the product">{{ $product->short_desc }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-outline-secondary w-100">Update Product</button>
                            </div>
                            <div class="col-lg-2">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-primary w-100">Cancel</a>
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
                            <h4 class="card-title">Product Categories</h4>
                        </div>
                        <div class="card-body">
                            <p class="text-muted mb-2"><a href="{{ route('admin.categories.create') }}"
                                                          class="float-end text-decoration-underline">Add
                                    New</a>Select product category</p>
                            <div class="border" style="padding: 5px 10px; max-height: 200px; overflow: scroll;">
                                @foreach($categories as $item)
                                    @php
                                        $marginLeft = 0;
                                    @endphp
                                    @include('components.admin.products.edit-category', ['category'=>$item, 'marginLeft'=>$marginLeft, 'product' => $product])
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
                                            <option value="{{ $id }}" @selected($product->brand_id == $id)>{{ $name }}</option>
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
                                            <option value="{{ $id }}" @selected(in_array($id, $product->tags->pluck('id')->toArray()))>{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection


@section('lib-script')
    <script src="{{ asset('theme/admin/assets/js/components/form-quilljs.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endsection

@section('script')
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
                        url: `/api/addAttribute/${attribute}`,
                        type: 'GET',
                        success: function (response) {
                            $('#product-attributes').append(response);
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

    </script>
@endsection
