@extends('admin.layouts.main')

@section('styles')
    <style>
        .ck-editor__editable_inline {
            min-height: 300px;
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl">

        <form action="{{ route('admin.posts.update', $post) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-xl-9 col-lg-8 ">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Post Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" id="title" value="{{ $post->title }}" name="title" class="form-control"
                                               placeholder="Enter title">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="slug" class="form-label">Slug</label>
                                        <input type="text" id="slug" name="slug"
                                               value="{{ $post->slug }}"
                                               class="form-control"
                                               placeholder="Enter slug">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <label for="content" class="form-label">Content</label>
                                        <div class="mb-3">
                                            <textarea id="content" name="content">
                                                {!! $post->content !!}
                                            </textarea>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Publish</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_active" type="checkbox" role="switch"
                                       id="is-active" value="1" @checked($post->is_active)>
                                <label class="form-check-label" for="is-active">Is Active</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="is_home" value="1" type="checkbox" role="switch"
                                       id="is-home" @checked($post->is_home)>
                                <label class="form-check-label" for="is-home">Is Home</label>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Post Thumbnail</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <input type="file" name="image" id="thumbnail" class="form-control">
                                    </div>
                                    @if($post->image)
                                        <img src="{{ Storage::url($post->image) }}" alt="" width="100px" height="100px">
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title d-inline-block">Tags</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <select class="form-control" id="choices-multiple-remove-button" data-choices
                                            data-choices-removeItem name="tags[]" multiple>
                                        @foreach($tags as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 bg-light mb-3 rounded">
                        <div class="row justify-content-center g-2">
                            <div class="col-lg-7">
                                <button type="submit" class="btn btn-outline-secondary w-100">Update Post</button>
                            </div>
                            <div class="col-lg-5">
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection

@section('lib-script')
    <script src="{{ asset('theme/admin/assets/vendor/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
@endsection

@section('script')
    <script>
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                window.editor = editor;
            })
            .catch(error => {
                console.error('There was a problem initializing the editor.', error);
            });
    </script>
@endsection
