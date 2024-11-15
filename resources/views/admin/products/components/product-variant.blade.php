@foreach($productVariants as $productVariant)
    @php
        $attributeValueIds = '';
    @endphp
    @foreach($productVariant as $item)
        @php
            $attributeValueIds .= $item->id .'-';
        @endphp
    @endforeach
    <div class="pe-4" id="variant-{{ $attributeValueIds }}">
        <div class="align-items-center">
            @foreach($productVariant as $item)
                <h5 class="d-inline-block mb-0 me-3">{{ $item->name }}</h5>
            @endforeach
            <button class="btn btn-sm btn-danger float-end btn-remove-variant" id="{{ $attributeValueIds }}"
                    type="button">Remove
            </button>
            <hr>
        </div>
        <div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label" for="variant-sku[{{ $attributeValueIds }}]">SKU</label>
                        <input type="text" class="form-control" id="variant-sku[{{ $attributeValueIds }}]"
                               name="product_variants[{{ $attributeValueIds }}][sku]"
                               placeholder="Enter SKU" value="{{ \Illuminate\Support\Str::random(8) }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label class="form-label" for="variant-image[{{ $attributeValueIds }}]">Image</label>
                        <input type="file" class="form-control"
                               name="product_variants[{{ $attributeValueIds }}][image]"
                               id="variant-image[{{ $attributeValueIds }}]"
                               placeholder="Enter manufacturer brand">
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label for="variant-quantity[{{ $attributeValueIds }}]" class="form-label">Stock</label>
                        <input type="number" id="variant-quantity[{{ $attributeValueIds }}]" name="product_variants[{{ $attributeValueIds }}][quantity]"
                               class="form-control" placeholder="Quantity">
                        {{--                        <label class="form-label" for="variant-quantity[{{ $attributeValueIds }}]">Quantity</label>--}}
                        {{--                        <input type="text" class="form-control" id="variant-quantity[{{ $attributeValueIds }}]"--}}
                        {{--                               placeholder="Stocks"--}}
                        {{--                               name="product_variants[{{ $attributeValueIds }}][variant_quantity]">--}}
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label for="variant-price[{{ $attributeValueIds }}]" class="form-label">Price</label>
                        <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20"><i
                                                            class="bx bx-dollar"></i></span>
                            <input type="number" id="variant-price[{{ $attributeValueIds }}]"
                                   name="product_variants[{{ $attributeValueIds }}][price]"
                                   class="form-control"
                                   placeholder="000">
                        </div>
                        {{--                        <label class="form-label" for="variant-price[{{ $attributeValueIds }}]">Price</label>--}}
                        {{--                        <div class="input-group has-validation mb-3">--}}
                        {{--                            <span class="input-group-text" id="variant-price-addon">$</span>--}}
                        {{--                            <input type="text" class="form-control" id="variant-price[{{ $attributeValueIds }}]"--}}
                        {{--                                   name="product_variants[{{ $attributeValueIds }}][variant_price]"--}}
                        {{--                                   placeholder="Enter price" aria-label="Price"--}}
                        {{--                                   aria-describedby="product-price-addon">--}}
                        {{--                        </div>--}}

                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="mb-3">
                        <label for="variant-price-sale[{{ $attributeValueIds }}]" class="form-label">Price Sale</label>
                        <div class="input-group mb-3">
                                                    <span class="input-group-text fs-20"><i
                                                            class="bx bx-dollar"></i></span>
                            <input type="number"
                                   id="variant-price-sale[{{ $attributeValueIds }}]"
                                   name="product_variants[{{ $attributeValueIds }}][price_sale]"
                                   class="form-control"
                                   placeholder="000">
                        </div>
                        {{--                        <label class="form-label" for="variant-price-sale[{{ $attributeValueIds }}]">Price--}}
                        {{--                            Sale</label>--}}
                        {{--                        <div class="input-group mb-3">--}}
                        {{--                                                        <span class="input-group-text"--}}
                        {{--                                                              id="variant-price-sale-addon">$</span>--}}
                        {{--                            <input type="text" class="form-control"--}}
                        {{--                                   id="variant-price-sale[{{ $attributeValueIds }}]"--}}
                        {{--                                   name="product_variants[{{ $attributeValueIds }}][variant_price_sale]"--}}
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
