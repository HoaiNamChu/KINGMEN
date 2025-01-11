@extends('admin.layouts.main')


@section('content')

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">

                <div class="col-xl-12 col-lg-12 ">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add Role</h4>
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
                                <form action="{{route('admin.roles.store')}}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-lg-12">

                                        <div class="mb-3">
                                            <label for="category-title" class="form-label">Role Name</label>
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
                                    <div class="mb-3">
                                        <label for="permissions" class="form-label">Permissions</label>
                                        <select name="permissions[]" class="form-control" multiple required>
                                            @foreach($permissions as $permission)
                                                <option value="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('permissions')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="form-check form-switch">
                                        <label for="is_active">Status</label>
                                        <input type="hidden" name="is_active" value="0">
                                        <!-- Trường ẩn: input type="hidden" với giá trị 0 sẽ được gửi khi biểu mẫu được gửi đi, bất kể checkbox có được chọn hay không.
                                        Checkbox: Nếu checkbox được chọn, giá trị 1 sẽ được gửi, và giá trị 0 từ trường ẩn sẽ bị ghi đè. -->

                                        <input class="form-check-input" type="checkbox" role="switch"
                                            id="flexSwitchCheckChecked1" name="is_active" value="1">
                                    </div>
                                    <br>
                                    <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary w-100">Save Change</button>
                                            </div>
                                            <div class="col-lg-2">
                                                <a href="{{route('admin.roles.index')}}"
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

        </div>
        <!-- End Container Fluid -->

@endsection
