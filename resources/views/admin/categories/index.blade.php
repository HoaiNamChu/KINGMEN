@extends('admin.layouts.main')


@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div
                            class="rounded bg-secondary-subtle d-flex align-items-center justify-content-center mx-auto">
                            <img src="{{ asset('theme/admin/assets/images/product/p-1.png') }}" alt=""
                                 class="avatar-xl">
                        </div>
                        <h4 class="mt-3 mb-0">Fashion Categories</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div
                            class="rounded bg-primary-subtle d-flex align-items-center justify-content-center mx-auto">
                            <img src="{{ asset('theme/admin/assets/images/product/p-6.png') }}" alt=""
                                 class="avatar-xl">
                        </div>
                        <h4 class="mt-3 mb-0">Electronics Headphone</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div
                            class="rounded bg-warning-subtle d-flex align-items-center justify-content-center mx-auto">
                            <img src="{{ asset('theme/admin/assets/images/product/p-7.png') }}" alt=""
                                 class="avatar-xl">
                        </div>
                        <h4 class="mt-3 mb-0">Foot Wares</h4>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body text-center">
                        <div
                            class="rounded bg-info-subtle d-flex align-items-center justify-content-center mx-auto">
                            <img src="{{ asset('theme/admin/assets/images/product/p-9.png') }}" alt=""
                                 class="avatar-xl">
                        </div>
                        <h4 class="mt-3 mb-0">Eye Ware & Sunglass</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">All Categories List</h4>

                        <a href="{{ route('admin.categories.create') }}" class="btn btn-sm btn-primary">
                            Add Category
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
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1"></label>
                                        </div>
                                    </th>
                                    <th>Categories</th>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Create At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $item)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" value="{{ $item->id }}" class="form-check-input" id="{{ $item->id }}">
                                                    <label class="form-check-label" for="{{ $item->id }}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div
                                                        class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                                        <img src="{{ \Illuminate\Support\Facades\Storage::url($item->image) }}"
                                                             alt="" class="avatar-md">
                                                    </div>
                                                    <p class="text-dark fw-medium fs-15 mb-0">{{ $item->name }}</p>
                                                </div>

                                            </td>
                                            <td>{{ $item->id }}</td>
                                            <td>100</td>
                                            <td>
                                                @if($item->is_active)
                                                    <span class="badge bg-success rounded-pill me-1">Active</span>
                                                @else
                                                    <span class="badge bg-danger rounded-pill me-1">In Active</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="#!" class="btn btn-light btn-sm">
                                                        <iconify-icon icon="solar:eye-broken"
                                                                      class="align-middle fs-18"></iconify-icon>
                                                    </a>
                                                    <a href="{{ route('admin.categories.edit', $item) }}" class="btn btn-soft-primary btn-sm">
                                                        <iconify-icon icon="solar:pen-2-broken"
                                                                      class="align-middle fs-18"></iconify-icon>
                                                    </a>
                                                    <form action="{{ route('admin.categories.destroy', $item) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-soft-danger btn-sm">
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
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
