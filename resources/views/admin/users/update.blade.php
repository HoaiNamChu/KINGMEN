@extends('admin.layouts.main')


@section('content')



<div class="wrapper">

    <div class="page-content">

        <div class="container-xxl">

            <div class="row">
                <div class="col-xl-9 col-lg-8 ">

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update User</h4>
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
                                <form action="{{ route('admin.users.update', $user->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Update Image User</h4>
                                            <img src="{{ Storage::url($user->avatar) }}" alt="{{$user->avatar}}"
                                                style="width: 300px; height: 120px;">
                                        </div>
                                        <div class="card-body">
                                            <!-- File Upload -->
                                            <div class="dz-message needsclick">
                                                <input type="file" name="avatar">
                                                <!-- chỉnh lại css cho phù hợp -->
                                                <i class="bx bx-cloud-upload fs-48 text-primary"></i>
                                                <h3 class="mt-4">Drop your images here, or <span
                                                        class="text-primary">click to browse</span></h3>
                                                <span class="text-muted fs-13">
                                                    1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are
                                                    allowed
                                                </span>

                                            </div>
                                            <hr>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">

                                        <div class="mb-3">
                                            <label for="brand-title" class="form-label">Name</label>
                                            <input name="name" type="text" class="form-control" placeholder="Enter Name"
                                                value="{{$user->name}}">
                                        </div>

                                    </div>
                                    <div class="col-lg-12">

                                        <div class="mb-3">
                                            <label for="brand-title" class="form-label">User Name</label>
                                            <input name="username" type="text" class="form-control"
                                                placeholder="Enter User Name" value="{{$user->username}}">
                                        </div>

                                    </div>

                                    <div class="col-lg-12">

                                        <label for="product-categories" class="form-label">Role User</label>
                                        <select class="form-control" data-choices data-choices-groups
                                            data-placeholder="Select Categories" name="roles[]" required>
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}" @if($user->roles->contains($role->id))
                                                selected @endif>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <!-- <br>
                                    <div class="col-lg-12">

                                        <div class="mb-3">
                                            <label for="brand-link" class="form-label">Password</label>
                                            <input name="password" type="password"  class="form-control"
                                                placeholder="****" value="{{$user->password}}">
                                        </div>


                                    </div> -->
                                    <br>
                                    <div class="col-lg-12">

                                        <label for="seller-location" class="form-label">Location</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fs-20"><iconify-icon
                                                    icon="solar:point-on-map-bold-duotone"
                                                    class="fs-18"></iconify-icon></span>
                                            <input name="address" type="text" class="form-control"
                                                placeholder="Add Address" value="{{$user->address}}">
                                        </div>

                                    </div>
                                    <div class="col-lg-12">

                                        <label for="seller-email" class="form-label">Email</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fs-20"><iconify-icon
                                                    icon="solar:letter-bold-duotone"
                                                    class="fs-18"></iconify-icon></span>
                                            <input name="email" type="email" class="form-control"
                                                placeholder="Add Email" value="{{$user->email}}">
                                        </div>

                                    </div>
                                    <div class="col-lg-12">

                                        <label for="seller-number" class="form-label">Phone Number</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text fs-20"><iconify-icon
                                                    icon="solar:outgoing-call-rounded-bold-duotone"
                                                    class="fs-20"></iconify-icon></span>
                                            <input name="phone" type="number" class="form-control"
                                                placeholder="Phone number" value="{{$user->phone}}">
                                        </div>

                                        <!-- <div class="col-lg-6">
                                            <label for="is_active">User Status:</label>
                                            <select class="form-control" data-choices data-choices-groups
                                                data-placeholder="Select Categories" id="is_active" name="is_active"
                                                required>
                                                <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
                                        </div> -->


                                        <div class="form-check form-switch">
                                            <label for="is_active">Status</label>
                                            <input class="form-check-input" type="checkbox" role="switch"
                                                id="flexSwitchCheckChecked1" id="is_active" name="is_active" value="1"
                                                {{ $user->is_active ? 'checked' : '' }}>
                                            <label for="is_active">
                                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                                            </label>
                                        </div>

                                    </div>
                                    <!-- <div class="col-lg-12">
                                        <label for="customRange1" class="form-label">Yearly Revenue</label>
                                        <div id="product-price-range" [data-slider-size="md" ] class=""></div>
                                        <div class="formCost row mt-2">
                                            <div class="col-lg-12">
                                                <input name="" class="form-control form-control-sm text-center"
                                                    type="text" id="minCost" value="0">
                                            </div>

                                            <div class="col-lg-12">
                                                <input name="" class="form-control form-control-sm text-center"
                                                    type="text" id="maxCost" value="1000">
                                            </div>
                                        </div>
                                    </div> -->
                                    <br>

                                    <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-outline-primary w-100">Update
                                                    User</button>
                                            </div>
                                            <div class="col-lg-2">
                                                <a href="{{route('admin.users.index')}}"
                                                    class="btn btn-secondary w-100">Cancel</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Seller Product Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="items-stock" class="form-label">Items Stock</label>
                                        <input name="" type="number" id="items-stock" class="form-control"
                                            placeholder="000">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="items-sells" class="form-label">Product Sells</label>
                                        <input name="" type="number" id="items-sells" class="form-control"
                                            placeholder="000">
                                    </div>

                                </div>
                                <div class="col-lg-4">

                                    <div class="mb-3">
                                        <label for="happy-client" class="form-label">Happy Client</label>
                                        <input name="" type="number" id="happy-client" class="form-control"
                                            placeholder="000">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div> -->

                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@section('lib-script')
<!-- Vector Map Js -->
<script src="{{ asset('theme/admin/assets/vendor/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/jsvectormap/maps/world.js') }}"></script>

<!-- Dashboard Js -->
<script src="{{ asset('theme/admin/assets/js/pages/dashboard.js') }}"></script>
@endsection