@extends('admin.layouts.main')


@section('content')

    <div class="container-xxl">

        <div class="row">
            <div class="col-lg-12">
                <form action="{{route('admin.users.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Add User</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="User-name" class="form-label">Name</label>
                                        <input type="text" value="{{ old('name') }}" name="name"
                                               class="form-control" placeholder="Enter Name">
                                        <span class="error-notification">
                                            @error('name')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="User-name" class="form-label"> User Name</label>
                                        <input type="text" value="{{ old('username') }}" name="username"
                                               class="form-control" placeholder="User name">
                                        <span class="error-notification">
                                            @error('username')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-6">

                                    <label for="product-categories" class="form-label">Role User</label>
                                    <select class="form-control" data-choices data-choices-groups
                                            data-placeholder="Select Categories" name="role[]" required>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="brand-image" class="form-label">User Thumbnail</label>
                                        <input type="file" name="avatar" class="form-control">
                                        <span class="error-notification">
                                            @error('avatar')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label for="User-name" class="form-label">Password</label>
                                        <input type="text" value="{{ old('password') }}" name="password"
                                               class="form-control" placeholder="Enter Password">
                                        <span class="error-notification">
                                            @error('password')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                                <div class="col-lg-12">

                                    <label for="seller-location" class="form-label">Location</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><iconify-icon
                                                icon="solar:point-on-map-bold-duotone"
                                                class="fs-18"></iconify-icon></span>
                                        <input name="address" type="text" class="form-control"
                                               placeholder="Add Address" value="{{ old('address') }}">
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <label for="seller-email" class="form-label">Email</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><iconify-icon
                                                icon="solar:letter-bold-duotone" class="fs-18"></iconify-icon></span>
                                        <input name="email" type="email" class="form-control"
                                               value="{{ old(key: 'email') }}" placeholder="Add Email">
                                        <span class="error-notification">
                                            @error('email')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <label for="seller-number" class="form-label">Phone Number</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20"><iconify-icon
                                                icon="solar:outgoing-call-rounded-bold-duotone"
                                                class="fs-20"></iconify-icon></span>
                                        <input name="phone" type="text" class="form-control"
                                               placeholder="Phone number" value="{{ old('phone') }}">
                                        <span class="error-notification">
                                            @error('phone')
                                            {{ $message }}
                                            @enderror
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-check form-switch">
                                        <label for="is_active">Status</label>
                                        <input type="hidden" name="is_active" value="0"
                                               value="{{ old(key: 'is_active') }}">
                                        <!-- Trường ẩn: input type="hidden" với giá trị 0 sẽ được gửi khi biểu mẫu được gửi đi, bất kể checkbox có được chọn hay không.
                                        Checkbox: Nếu checkbox được chọn, giá trị 1 sẽ được gửi, và giá trị 0 từ trường ẩn sẽ bị ghi đè. -->

                                        <input class="form-check-input" type="checkbox" role="switch"
                                               id="flexSwitchCheckChecked1" name="is_active" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top">
                            <div class="col-lg-6">
                                <button type="submit" class="btn btn-primary">Create User</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>


            <div class="col-lg-6">
                <a href="{{route('admin.users.index')}}">
                    <button class="btn btn-secondary">Cance</button>
                </a>
            </div>

        </div>
    </div>

@endsection
