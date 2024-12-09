@extends('admin.layouts.main')


@section('content')
<div class="container-xxl">
    <div class="row">
        <div class="col-xl-9 col-lg-8">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="bg-primary profile-bg rounded-top position-relative mx-n3 mt-n3">
                        <img src="{{ Storage::url($user->avatar) }}" alt="{{$user->avatar}}"
                            class="avatar-xl border border-light border-3 rounded-circle position-absolute top-100 start-0 translate-middle ms-5">
                    </div>
                    <div class="mt-5 d-flex flex-wrap align-items-center justify-content-between">
                        <div>
                            <h4 class="mb-1">{{$user->name}} <i
                                    class='bx bxs-badge-check text-success align-middle'></i>
                            </h4>
                            <p class="mb-0">{{$user->username}}</p>
                        </div>
                        <div class="d-flex align-items-center gap-2 my-2 my-lg-0">
                            <button class="btn btn-info">
                            <!-- list danh sach user co cung role tai day -->


                                        @foreach($user->roles as $role)
                                            {{ $role->name }}
                                        @endforeach



                            </button>
                            <a href="{{route('admin.users.index')}}" class="btn btn-outline-primary"></i> Cance</a>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <iconify-icon icon="solar:menu-dots-bold"
                                        class="fs-20 align-middle text-muted"></iconify-icon>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <script>
                                        // Hàm để xác nhận xóa
                                        function confirmDelete(event) {
                                            if (!confirm('Bạn có chắc chắn muốn xóa User này?')) {
                                                event.preventDefault(); // Hủy bỏ hành động xóa nếu người dùng không xác nhận
                                            }
                                        }
                                    </script>
                                    <!-- item-->

                                    <a href="{{route('admin.users.destroy', $user->id)}}" class="dropdown-item"
                                        onclick="confirmDelete(event)">Delete</a>
                                    <!-- item-->
                                    <!-- <a href="#" class="dropdown-item">Created at </a> -->
                                    <!-- item-->

                                    <a href="{{route('admin.users.edit', $user->id)}}" class="dropdown-item">Updated</a>
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
                    <h4 class="card-title">Personal Information</h4>
                </div>
                <div class="card-body">
                    <div class="">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                                <iconify-icon icon="solar:backpack-bold-duotone"
                                    class="fs-20 text-secondary"></iconify-icon>
                            </div>
                            <p class="mb-0 fs-14">{{$user->phone}}</p>
                        </div>

                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                                <iconify-icon icon="solar:map-point-bold-duotone"
                                    class="fs-20 text-secondary"></iconify-icon>
                            </div>
                            <p class="mb-0 fs-14">Address <span class="text-dark fw-semibold">{{$user->address}}</span>
                            </p>
                        </div>

                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                                <iconify-icon icon="solar:letter-bold-duotone"
                                    class="fs-20 text-secondary"></iconify-icon>
                            </div>
                            <p class="mb-0 fs-14">Email <a href="#!"
                                    class="text-primary fw-semibold">{{$user->email}}</a></p>
                        </div>



                        <div class="d-flex align-items-center gap-2">
                            <div class="avatar-sm bg-light d-flex align-items-center justify-content-center rounded">
                                <iconify-icon icon="solar:check-circle-bold-duotone"
                                    class="fs-20 text-secondary"></iconify-icon>
                            </div>
                            <p class="mb-0 fs-14">Status
                                @if($user->is_active == 1)
                                    <span class="text-success"
                                        class="badge bg-success-subtle text-success ms-1">Active</span>
                                @else
                                    <span class="text-danger"
                                        class="badge bg-success-subtle text-danger ms-1">Inactive</span>
                                @endif
                            </p>
                        </div>

                    </div>
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
