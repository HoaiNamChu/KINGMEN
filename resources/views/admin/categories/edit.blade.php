@extends('admin.layouts.main')

@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-12 col-lg-12 ">
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
                                    <span class="error-notification">
                                            @error('image')
                                        {{ $message }}
                                        @enderror
                                        </span>
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
                                        <span class="error-notification">
                                            @error('name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="brand-slug" class="form-label">Slug</label>
                                        <input type="text" id="brand-slug" name="slug" class="form-control"
                                               placeholder="Slug" value="{{ $category->slug }}">
                                        <span class="error-notification">
                                            @error('slug')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
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
                                                @include('admin.categories.components.edit', ['item'=>$item, 'dash' => $dash, 'category' => $category])
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
                                        <span class="error-notification">
                                            @error('description')
                                            {{ $message }}
                                            @enderror
                                        </span>
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
                                        <span class="error-notification">
                                            @error('is_active')
                                            {{ $message }}
                                            @enderror
                                        </span>
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
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection


