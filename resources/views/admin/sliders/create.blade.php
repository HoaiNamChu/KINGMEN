@extends('admin.layouts.main')
@section('content')
    <div class="container-xxl">

        <div class="row">
            <div class="col-lg-12">
                <form action="{{ route('admin.slides.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Slider</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Slide Title</label>
                                        <input type="text" id="title" value="{{ old('title') }}" name="title"
                                               class="form-control"
                                               placeholder="Slider title">
                                        <span class="error-notification">
                                            @error('title')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="slide-image" class="form-label">Slider Image</label>
                                        <input type="file" id="slide-image" name="image" class="form-control">
                                        <span class="error-notification">
                                            @error('image')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="link" class="form-label">Link</label>
                                        <input type="text" id="link" value="{{ old('link') }}" name="link"
                                               class="form-control"
                                               placeholder="Slider link">
                                        <span class="error-notification">
                                            @error('link')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="content" class="form-label">Content</label>
                                        <input type="text" id="content" value="{{ old('content') }}" name="content"
                                               class="form-control"
                                               placeholder="Slider content">
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
                                        <textarea class="form-control bg-light-subtle" name="description"
                                                  id="description"
                                                  rows="7"
                                                  placeholder="Slider description">{{ old('description') }}</textarea>
                                        <span class="error-notification">
                                        @error('description')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <p>Slier Status </p>
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
                            <button type="submit" class="btn btn-primary">Create Slider</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
