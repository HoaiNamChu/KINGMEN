@extends('admin.layouts.main')


@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-4">
                <form action="{{ route('admin.tags.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tags Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="tags-name" class="form-label">Tag Name</label>
                                        <input type="text" id="tags-name" value="{{ old('name') }}" name="name"
                                               class="form-control"
                                               placeholder="Tag name">
                                        <span class="error-notification">
                                            @error('name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="tags-slug" class="form-label">Tag Slug</label>
                                        <input type="text" id="tags-slug" value="{{ old('slug') }}" name="slug"
                                               class="form-control"
                                               placeholder="Tag slug">
                                        <span class="error-notification">
                                            @error('slug')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control bg-light-subtle" name="description"
                                                  id="description"
                                                  rows="7"
                                                  placeholder="Type description">{{ old('description') }}</textarea>
                                        <span class="error-notification">
                                        @error('description')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <p>Tag Status </p>
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
                            <button type="submit" class="btn btn-primary">Create Tag</button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">All Categories List</h4>
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
                                    <th>Tag</th>
                                    <th>Slug</th>
                                    <th>ID</th>
                                    <th>Status</th>
                                    <th>Create at</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($tags as $item)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="{{ $item->id }}">
                                                <label class="form-check-label" for="{{ $item->id }}"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-info me-1">{{ $item->name }}</span>
                                        </td>
                                        <td>{{ $item->slug }}</td>
                                        <td>{{ $item->id }}</td>
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
                                                <a href="{{ route('admin.tags.edit', $item) }}"
                                                   class="btn btn-soft-primary btn-sm">
                                                    <iconify-icon icon="solar:pen-2-broken"
                                                                  class="align-middle fs-18"></iconify-icon>
                                                </a>
                                                <form action="{{ route('admin.tags.destroy', $item) }}" method="post">
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
                                {{ $tags->links() }}
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

