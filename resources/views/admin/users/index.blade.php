@extends('admin.layouts.main')


@section('content')

<div class="table-responsive table-centered">
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
                    Phone
                </th>
                <th>
                    Email
                </th>
                <th>
                    Address
                </th>
                <th>
                    Avatar
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
                <td>{{ $user->phone }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->address }}</td>
                <td>
                    @if($user->avatar)
                        <img src="{{ $user->avatar }}" alt="Avatar">
                    @else
                        <span>Không có</span>
                    @endif
                </td>
                <!-- <td>{{ $user->email_verified_at ? 'Đã xác thực' : 'Chưa xác thực' }}</td>
                <td>{{ $user->is_active ? 'Hoạt động' : 'Không hoạt động' }}</td> -->
                <td>{{ $user->created_at }}</td>
                <td>{{ $user->updated_at }}</td>
            </tr>
            @endforeach
        </tbody>
        <!-- end tbody -->
    </table>
    <!-- end table -->
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