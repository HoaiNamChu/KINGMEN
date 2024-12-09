@extends('admin.layouts.main')

@section('link')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">All Product List</h4>

                        <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">
                            Add Product
                        </a>

                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                This Month
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Download</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Export</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Import</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0 table-hover table-centered">
                                <thead class="bg-light-subtle">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check ms-1">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1"></label>
                                        </div>
                                    </th>
                                    <th>Product Name & Size</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $item)
                                    <tr>
                                        <td>
                                            <div class="form-check ms-1">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center gap-2">
                                                <div
                                                    class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                    <img
                                                        src="{{ \Illuminate\Support\Facades\Storage::url($item->image) }}"
                                                        alt="" class="avatar-md">
                                                </div>
                                                <div>
                                                    <a href="{{ route('admin.products.edit', $item) }}"
                                                       class="text-dark fw-medium fs-15">{{ $item->name }}</a>
                                                    {{--                                                    <p class="text-muted mb-0 mt-1 fs-13"><span>Size : </span>S , M , L--}}
                                                    {{--                                                        , Xl </p>--}}
                                                </div>
                                            </div>

                                        </td>
                                        <td>
                                            @if($item->variants->isEmpty())
                                                @if($item->is_sale)
                                                    <span class="text-decoration-line-through">{{ number_format($item->price) }} VND</span>
                                                    <span>-</span>
                                                    <span>{{ number_format($item->price_sale) }} VND</span>
                                                @else
                                                    <span>{{ number_format($item->price) }} VND</span>
                                                @endif
                                            @else
                                                <span>{{ number_format($item->price_sale) }} VND</span>
                                                <span>-</span>
                                                <span>{{ number_format($item->price) }} VND</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $item->quantity }}
                                        </td>
                                        <td> {{ $item->brand ? $item->brand->name : "No brand" }}</td>
                                        <td> @if($item->categories->count())
                                                @foreach($item->categories as $cate)
                                                    <a href="{{ route('admin.categories.show', $cate) }}">{{ $cate->name }}</a>
                                                    ,
                                                @endforeach
                                            @else
                                                {{ "No category" }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.products.show', $item) }}"
                                                   class="btn btn-light btn-sm">
                                                    <iconify-icon icon="solar:eye-broken"
                                                                  class="align-middle fs-18"></iconify-icon>
                                                </a>
                                                <a href="{{ route('admin.products.edit', $item) }}"
                                                   class="btn btn-soft-primary btn-sm">
                                                    <iconify-icon icon="solar:pen-2-broken"
                                                                  class="align-middle fs-18"></iconify-icon>
                                                </a>
                                                <form action="{{ route('admin.products.destroy', $item) }}"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-soft-danger btn-sm">
                                                        <iconify-icon icon="solar:trash-bin-minimalistic-2-broken"
                                                                      class="align-middle fs-18"></iconify-icon>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                    <div class="card-footer border-top">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mb-0">
                                {{ $products->links() }}
                                {{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a>--}}
                                {{--                                </li>--}}
                                {{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>--}}
                                {{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>--}}
                                {{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>--}}
                            </ul>
                        </nav>
                    </div>
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
