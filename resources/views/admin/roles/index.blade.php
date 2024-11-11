@extends('admin.layouts.main')


@section('content')




<div class="table-responsive">
    <table class="table align-middle mb-0 table-hover table-centered">
        <thead class="bg-light-subtle">
            <tr>
                <th class="ps-3">
                    ID.
                </th>
                <th>
                    Name
                </th>
                <th>
                    description
                </th>
                <th>
                    status
                </th>
                <th>
                    created at
                </th>
                <th>
                    updated at
                </th>
                <th>
                    action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)

                <tr>
                    <td>{{$role->id}}</td>
                    <td>
                        <!-- <img src="assets/images/app-calendar/facebook.png" class="avatar-xs rounded-circle me-1" alt="..."> -->
                        {{ $role->name }}
                    </td>
                    <td>
                        {{ $role->description }}
                    </td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <p class="mb-0 fs-14">Status
                                @if($role->is_active == 1)
                                    <span class="text-success" class="badge bg-success-subtle text-success ms-1">Active</span>
                                @else
                                    <span class="text-danger" class="badge bg-success-subtle text-danger ms-1">Inactive</span>
                                @endif
                            </p>
                        </div>
                    </td>
                    <td>
                        {{ $role->created_at }}
                    </td>
                    <td>
                        {{ $role->updated_at }}
                    </td>

                    <td>
                        <div class="d-flex gap-2">
                            <!-- <a href="#!" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken"
                                        class="align-middle fs-18"></iconify-icon></a> -->
                            <a href="{{route('admin.roles.edit', $role->id)}}"
                                class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken"
                                    class="align-middle fs-18"></iconify-icon></a>

                            <script>
                                // Hàm để xác nhận xóa
                                function confirmDelete(event) {
                                    if (!confirm('Bạn có muốn xóa Quyền {{$role->name}} không?')) {
                                        event.preventDefault(); // Hủy bỏ hành động xóa nếu người dùng không xác nhận
                                    }
                                }
                            </script>
                            <form action="{{route('admin.roles.destroy', $role->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-soft-danger btn-sm"
                                    onclick="confirmDelete(event)"><iconify-icon
                                        icon="solar:trash-bin-minimalistic-2-broken"
                                        class="align-middle fs-18"></iconify-icon></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
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