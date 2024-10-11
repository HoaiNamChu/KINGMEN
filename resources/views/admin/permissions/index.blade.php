@extends('admin.layouts.main')


@section('content')
<h1>Permissions</h1>

<a href="{{ route('admin.permissions.create') }}" class="btn btn-outline-primary"><i class="bx bx-plus"></i> Create Permission</a>

<div class="table-responsive">
    <table class="table align-middle mb-0 table-hover table-centered">
        <thead class="bg-light-subtle">
            <tr>
                <!-- <th style="width: 20px;">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="customCheck1">
                        <label class="form-check-label" for="customCheck1"></label>
                    </div>
                </th> -->
                <th>id</th>
                <th>Name</th>
                <th>Assigned To</th>
                <th>Description</th>
                <th>Created Date &amp; Time</th>
                <th>Last Update</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($permissions as $permission)
            <tr>
                <!-- <td>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="customCheck2">
                        <label class="form-check-label" for="customCheck2">&nbsp;</label>
                    </div>
                </td> -->
                <td>{{ $permission->id }}</td>
                <td>
                    <p class="fs-15 mb-0">{{ $permission->name }}</p>
                </td>
                <td>
                    @if($permission->roles->isEmpty())
                        No roles assigned
                    @else
                        @foreach($permission->roles as $role)
                            <span class="badge bg-info-subtle text-info py-1 px-2 fs-11">{{ $role->name }}</span>
                        @endforeach
                    @endif
                </td>
                <td>{{ $permission->description }} </td>
                <td>{{ $permission->created_at }}</td>
                <td>{{ $permission->updated_at }}</td>
                <td>
                    <div class="d-flex gap-2">
                        <!-- <a href="#!" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken"
                                class="align-middle fs-18"></iconify-icon></a> -->
                                <a href="{{route('admin.permissions.edit', $permission->id)}}"
                                class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken"
                                    class="align-middle fs-18"></iconify-icon></a>
                                <script>
                                // Hàm để xác nhận xóa
                                function confirmDelete(event) {
                                    if (!confirm('Bạn có muốn xóa Quyền {{$permission->name}} không?')) {
                                        event.preventDefault(); // Hủy bỏ hành động xóa nếu người dùng không xác nhận
                                    }
                                }
                            </script>
                         <form action="{{route('admin.permissions.destroy', $permission->id)}}" method="post">
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