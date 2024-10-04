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
                    description
                </th>
                <th>
                    created_at
                </th>
                <th>
                    updated_at
                </th>
                <th>
                    action
                </th>
            </tr>
        </thead>
        <!-- end thead-->
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->description }}</td>
                    <td>{{ $role->created_at }}</td>
                    <td>{{ $role->updated_at }}</td>
                    <td>
                        <a href="{{route('roles.edit', $role->id)}}"><button class="btn btn"
                                style="background-color: orange;">Update</button></a>
                        <script>
                            // Hàm để xác nhận xóa
                            function confirmDelete(event) {
                                if (!confirm('Bạn có chắc chắn muốn xóa role này?')) {
                                    event.preventDefault(); // Hủy bỏ hành động xóa nếu người dùng không xác nhận
                                }
                            }
                        </script>
                        <form action="{{route('roles.destroy', $role->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirmDelete(event)" class="btn" style="background-color:crimson; color:white;">Delete</button>
                        </form>
                    </td>

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