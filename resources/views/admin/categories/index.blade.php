@extends('admin.layouts.main')


@section('content')
    <div class="container-xxl">
        <div class="row">
            <div class="col-lg-4">
                <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Category Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="category-name" class="form-label">Category Name</label>
                                        <input type="text" id="category-name" name="name" class="form-control"
                                               placeholder="Category name">
                                        <span class="error-notification">
                                            @error('name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="brand-image" class="form-label">Category Thumbnail</label>
                                        <input type="file" id="brand-image" name="image" class="form-control">
                                        <span class="error-notification">
                                            @error('image')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="crater" class="form-label">Parent</label>
                                        <select class="form-control" id="crater" name="parent_id" data-choices
                                                data-choices-sorting-false
                                                data-placeholder="Select Parent">
                                            <option value="">Select Parent</option>
                                            @foreach($categories as $item)
                                                @php
                                                    $dash = ' ';
                                                @endphp
                                                @include('admin.categories.components.create', ['item'=>$item, 'dash' => $dash])
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control bg-light-subtle" name="description"
                                                  id="description"
                                                  rows="7"
                                                  placeholder="Type description"></textarea>
                                        <span class="error-notification">
                                            @error('description')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <p>Category Status </p>
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
                                        <span class="error-notification">
                                            @error('is_active')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer border-top">
                            <button type="submit" class="btn btn-primary">Create Category</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-8">
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
                                    @php
                                        $dash = '';
                                    @endphp
                                    @include('admin.categories.components.index', ['item' => $item, 'dash' => $dash])
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                    <div class="card-footer border-top">
{{--                        <nav aria-label="Page navigation example">--}}
{{--                            <ul class="pagination justify-content-end mb-0">--}}
{{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a>--}}
{{--                                </li>--}}
{{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>--}}
{{--                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>--}}
{{--                            </ul>--}}
{{--                        </nav>--}}
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


