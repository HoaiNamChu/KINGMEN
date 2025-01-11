@extends('admin.layouts.main')


@section('content')
<div class="container-xxl">

    <div class="row">

        <div class="col-xl-12 col-lg-12 ">

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Add Permission</h4>
                </div>


                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="card-body">
                            <div class="row">
                                <form action="{{route('admin.permissions.store')}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-12">

                                        <div class="mb-3">
                                            <label for="category-title" class="form-label">Permission Name</label>
                                            <input type="text" name="name" id="" class="form-control"
                                                placeholder="Enter Title">
                                        </div>

                                    </div>


                                    <div class="col-lg-12">
                                        <div class="mb-0">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control bg-light-subtle" name="description" id=""
                                                rows="7" placeholder="Type description"></textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary w-100">Save Change</button>
                                            </div>
                                            <div class="col-lg-2">
                                                <a href="{{route('admin.permissions.index')}}"
                                                    class="btn btn-outline-secondary w-100">Cancel</a>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

            </div>
        </div>
    </div>
    @endsection
