@extends('admin.layouts.main')


@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <form action="{{ route('admin.attributes.store') }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title">Add Attribute</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="variant-name" class="form-label text-dark">Attribute
                                            Variant</label>
                                        <input type="text" id="variant-name" name="name" class="form-control"
                                               placeholder="Enter Name">
                                        <span class="error-notification">
                                            @error('name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="variant-slug" class="form-label text-dark">Slug</label>
                                        <input type="text" id="variant-slug" name="slug" class="form-control"
                                               placeholder="Enter Slug">
                                        <span class="error-notification">
                                            @error('slug')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="choices-text-unique-values" class="form-label text-dark">Attribute
                                            Value</label>
                                        <input class="form-control" id="choices-text-unique-values"
                                               name="attribute_value" data-choices
                                               data-choices-text-unique-true type="text"/>
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
                                    <p>Attribute Status </p>
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
                            <button type="submit" class="btn btn-primary">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">All Attributes List</h4>

                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light" data-bs-toggle="dropdown"
                               aria-expanded="false">
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
                                    <th>ID</th>
                                    <th>Variant</th>
                                    <th>Value</th>
                                    <th>Created at</th>
                                    <th>Published</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($attributes as $item)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="{{ $item->id }}">
                                                <label class="form-check-label" for="{{ $item->id }}">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            @foreach($item->attributeValues as $value)
                                                <a href="{{ route('admin.attributeValues.edit', $value) }}">{{ $value->name }}</a>
                                                ,
                                            @endforeach
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" role="switch"
                                                       id="flexSwitchCheckChecked1" @checked($item->is_active)>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('admin.attributes.edit', $item) }}"
                                                   class="btn btn-soft-primary btn-sm">
                                                    <iconify-icon icon="solar:pen-2-broken"
                                                                  class="align-middle fs-18"></iconify-icon>
                                                </a>
                                                <form action="{{ route('admin.attributes.destroy', $item) }}"
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
                                {{ $attributes->links() }}
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

