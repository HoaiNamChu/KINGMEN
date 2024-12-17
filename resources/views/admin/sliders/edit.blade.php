@extends('admin.layouts.main')

@section('link')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-xl-9 col-lg-8 ">
                <form action="{{ route('admin.slides.update', $slide) }}" method="post" enctype="multipart/form-data">
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
                                        <label for="slide-title" class="form-label">Slide Title</label>
                                        <input type="text" id="slide-title" name="title" class="form-control"
                                               placeholder="Enter Title" value="{{ $slide->title }}">
                                        <span class="error-notification">
                                            @error('title')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="slide-link" class="form-label">Link</label>
                                        <input type="text" id="slide-link" name="link" class="form-control"
                                               placeholder="Link" value="{{ $slide->link }}">
                                        <span class="error-notification">
                                            @error('link')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="slide-content" class="form-label">Content</label>
                                        <input type="text" id="slide-content" name="content" class="form-control"
                                               placeholder="content" value="{{ $slide->content }}">
                                        <span class="error-notification">
                                            @error('content')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control bg-light-subtle" id="description" name="description"
                                                  rows="7"
                                                  placeholder="Type description">{{ $slide->description }}</textarea>
                                        <span class="error-notification">
                                            @error('description')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <p>Slide Status </p>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="1" name="is_active"
                                                   id="is_active1" @checked($slide->is_active)>
                                            <label class="form-check-label" for="is_active1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="0" name="is_active"
                                                   id="is_active2" @checked(!$slide->is_active)>
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
                                <a href="{{ route('admin.slides.index') }}" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="bg-light text-center rounded bg-light">
                            <img src="{{ \Illuminate\Support\Facades\Storage::url($slide->image) }}" alt="image"
                                 class="img-fluid img-thumbnail" width="200"/>
                        </div>
                        <div class="mt-3">
                            <h4>{{ $slide->title }}</h4>
                            <div class="row">
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">Created At :</p>
                                    <h5 class="mb-0">{{ $slide->created_at }}</h5>
                                </div>
                                
                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">Updated At :</p>
                                    <h5 class="mb-0">{{ $slide->updated_at }}</h5>
                                </div>

                                <div class="col-lg-4 col-4">
                                    <p class="mb-1 mt-2">ID :</p>
                                    <h5 class="mb-0">{{ $slide->id }}</h5>
                                </div>
                            </div>
                        </div>
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

    </script>

@endsection
