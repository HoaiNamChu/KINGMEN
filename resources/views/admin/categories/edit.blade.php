@extends('admin.layouts.main')

@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-light text-center rounded bg-light">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($category->image) }}" alt="image"
                                 class="img-fluid img-thumbnail" width="200"/>
                        </div>
                        <div class="mt-3">
                            <h4>{{ $category->name }}</h4>
                            <div class="row">
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">Created At :</p>
                                    <h5 class="mb-0">{{ $category->created_at }}</h5>
                                </div>
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">Product :</p>
                                    <h5 class="mb-0">100</h5>
                                </div>
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">ID :</p>
                                    <h5 class="mb-0">{{ $category->id }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9 col-lg-8 ">
                <form action="{{ route('admin.categories.update', $category) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Thumbnail Photo</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-lg-6">
                                <div>
                                    <input type="file" name="image" class="form-control">
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
                                        <label for="brand-name" class="form-label">Brand Name</label>
                                        <input type="text" id="brand-name" name="name" class="form-control"
                                               placeholder="Enter Title" value="{{ $category->name }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="brand-slug" class="form-label">Slug</label>
                                        <input type="text" id="brand-slug" name="slug" class="form-control"
                                               placeholder="Slug" value="{{ $category->slug }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="crater" class="form-label">Parent</label>
                                        <select class="form-control" id="crater" name="parent_id" data-choices
                                                data-choices-groups
                                                data-placeholder="Select Parent">
                                            <option value="">Select Parent</option>
                                            @foreach($categories as $item)
                                                @php
                                                    $dash = ' ';
                                                @endphp
                                                @include('components.admin.categories.edit', ['item'=>$item, 'dash' => $dash, 'category' => $category])
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control bg-light-subtle" id="description"
                                                  name="description"
                                                  rows="7"
                                                  placeholder="Type description">{{ $category->description }}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <p>Brand Status </p>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" name="is_active"
                                                   id="is_active1" @checked($category->is_active)>
                                            <label class="form-check-label" for="is_active1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="0" name="is_active"
                                                   id="is_active2" @checked(!$category->is_active)>
                                            <label class="form-check-label" for="is_active2">
                                                In Active
                                            </label>
                                        </div>
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
                                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
