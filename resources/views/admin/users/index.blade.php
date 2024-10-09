@extends('admin.layouts.main')


@section('content')

@if(in_array(1, $userRoles)) <!-- Role ID 1 cho admin -->
    <div class="table-responsive table-centered">
        <a href="{{route('admin.users.create')}}"> <button class="btn btn-outline-secondary">Add</button></a>
        <table class="table mb-0">
            <thead class="bg-light bg-opacity-50">
                <tr>
                    <th class="ps-3">
                        ID.
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        User Name
                    </th>
                    <th>
                        Avatar
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <!-- end thead-->
            <tbody>
                @foreach($data as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" style="width: 200px; height: 130px;">
                            @else
                                <span>Không có</span>
                            @endif
                        </td>
                        <!-- <td>{{ $user->email_verified_at ? 'Đã xác thực' : 'Chưa xác thực' }}</td>
                                                <td>{{ $user->is_active ? 'Hoạt động' : 'Không hoạt động' }}</td> -->
                        <td>
                            <script>
                                // Hàm để xác nhận xóa
                                function confirmDelete(event) {
                                    if (!confirm('Bạn có chắc chắn muốn xóa nguời dùng {{$user->name}}?')) {
                                        event.preventDefault(); // Hủy bỏ hành động xóa nếu người dùng không xác nhận
                                    }
                                }
                            </script>


                            <div class="d-flex gap-2">
                                <a href="{{Route('admin.users.show', $user->id)}}" class="btn btn-light btn-sm"><iconify-icon
                                        icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                <!-- <a href="role-edit.html" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a> -->
                                <form action="{{route('admin.users.destroy', $user->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="confirmDelete(event)"
                                        class="btn btn-soft-danger btn-sm"><iconify-icon
                                            icon="solar:trash-bin-minimalistic-2-broken"
                                            class="align-middle fs-18"></iconify-icon></button>
                                </form>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!-- end tbody -->
        </table>
        <!-- end table -->
    </div>
@endif

@if(in_array(2, $userRoles)) <!-- Role ID 2 cho nhân viên -->
    <h3>Tài Khoản không được truy cập</h3>
@endif
@if(in_array(3, $userRoles)) <!-- Role ID 3 cho người dùng -->
    <h3>Tài Khoản không được truy cập</h3>
@endif


@endsection


@section('lib-script')
<!-- Vector Map Js -->
<script src="{{ asset('theme/admin/assets/vendor/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ asset('theme/admin/assets/vendor/jsvectormap/maps/world.js') }}"></script>

<!-- Dashboard Js -->
<script src="{{ asset('theme/admin/assets/js/pages/dashboard.js') }}"></script>
@endsection