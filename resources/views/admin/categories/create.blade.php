@extends('admin.layouts.main')


@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-light text-center rounded bg-light">
                            <img src="{{ asset('theme/admin/assets/images/product/p-1.png') }}" alt=""
                                 class="avatar-xxl">
                        </div>
                        <div class="mt-3">
                            <h4>Fashion Men , Women & Kid's</h4>
                            <div class="row">
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">Created By :</p>
                                    <h5 class="mb-0">Seller</h5>
                                </div>
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">Stock :</p>
                                    <h5 class="mb-0">46233</h5>
                                </div>
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">ID :</p>
                                    <h5 class="mb-0">FS16276</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <div class="row g-2">
                            <div class="col-lg-6">
                                <a href="#!" class="btn btn-outline-secondary w-100">Create Category</a>
                            </div>
                            <div class="col-lg-6">
                                <a href="#!" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 ">
                <form action="{{ route('admin.categories.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Thumbnail Photo</h4>
                        </div>
                        <div class="card-body">
                            <!-- File Upload -->
                            {{--                        <form action="https://techzaa.getappui.com/" method="post" class="dropzone"--}}
                            {{--                              id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews"--}}
                            {{--                              data-upload-preview-template="#uploadPreviewTemplate">--}}
                            {{--                            <div class="fallback">--}}
                            {{--                                <input name="file" type="file" multiple/>--}}
                            {{--                            </div>--}}
                            {{--                            <div class="dz-message needsclick">--}}
                            {{--                                <i class="bx bx-cloud-upload fs-48 text-primary"></i>--}}
                            {{--                                <h3 class="mt-4">Drop your images here, or <span--}}
                            {{--                                        class="text-primary">click to browse</span>--}}
                            {{--                                </h3>--}}
                            {{--                                <span class="text-muted fs-13">--}}
                            {{--                                                       1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed--}}
                            {{--                                                  </span>--}}
                            {{--                            </div>--}}
                            {{--                        </form>--}}
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="category-thumbnail" class="form-label">Category Thumbnail</label>
                                    <input type="file" name="image" id="category-thumbnail" class="form-control"
                                           placeholder="Enter Title">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">General Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="category-name" class="form-label">Category Name</label>
                                        <input type="text" name="name" id="category-name" class="form-control"
                                               placeholder="Enter Name">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="category-parent" class="form-label">Category Parent</label>
                                    <select class="form-control" name="parent_id" id="category-parent" data-choices data-choices-groups
                                            data-placeholder="Select Crater">
                                        <option value="">Select Crater</option>
                                        <option value="1">Seller</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Other</option>
                                    </select>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" role="switch" id="is-active" checked>
                                            <label class="form-check-label" for="is-active">Is Active</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-0">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control bg-light-subtle" name="description" id="description" rows="7"
                                                  placeholder="Type description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-2">
                                <button type="submit" class="btn btn-outline-secondary w-100">Save Change</button>
                            </div>
                            <div class="col-lg-2">
                                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

