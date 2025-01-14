@extends('admin.layouts.main')


@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center gap-1">
                        <h4 class="card-title flex-grow-1">All Permission List</h4>

                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">
                            Add Permission
                        </a>

                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                This Month
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Download</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Export</a>
                                <!-- item-->
                                <a href="#!" class="dropdown-item">Import</a>
                            </div>
                        </div>
                    </div>
                    <div>
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
{{--                                    <th>Created Date &amp; Time</th>--}}
{{--                                    <th>Last Update</th>--}}
{{--                                    <th>Action</th>--}}
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
                                                    <span
                                                        class="badge bg-info-subtle text-info py-1 px-2 fs-11">{{ $role->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>{{ $permission->description }} </td>
{{--                                        <td>{{ $permission->created_at }}</td>--}}
{{--                                        <td>{{ $permission->updated_at }}</td>--}}
{{--                                        <td>--}}
{{--                                            <div class="d-flex gap-2">--}}
{{--                                                <!-- <a href="#!" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken"--}}
{{--                                                        class="align-middle fs-18"></iconify-icon></a> -->--}}
{{--                                                <a href="{{route('admin.permissions.edit', $permission->id)}}"--}}
{{--                                                   class="btn btn-soft-primary btn-sm">--}}
{{--                                                    <iconify-icon icon="solar:pen-2-broken"--}}
{{--                                                                  class="align-middle fs-18"></iconify-icon>--}}
{{--                                                </a>--}}
{{--                                                <script>--}}
{{--                                                    // Hàm để xác nhận xóa--}}
{{--                                                    function confirmDelete(event) {--}}
{{--                                                        if (!confirm('Bạn có muốn xóa Quyền {{$permission->name}} không?')) {--}}
{{--                                                            event.preventDefault(); // Hủy bỏ hành động xóa nếu người dùng không xác nhận--}}
{{--                                                        }--}}
{{--                                                    }--}}
{{--                                                </script>--}}
{{--                                                <form action="{{route('admin.permissions.destroy', $permission->id)}}"--}}
{{--                                                      method="post">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <button type="submit" class="btn btn-soft-danger btn-sm"--}}
{{--                                                            onclick="confirmDelete(event)">--}}
{{--                                                        <iconify-icon--}}
{{--                                                            icon="solar:trash-bin-minimalistic-2-broken"--}}
{{--                                                            class="align-middle fs-18"></iconify-icon>--}}
{{--                                                    </button>--}}
{{--                                                </form>--}}
{{--                                            </div>--}}
{{--                                        </td>--}}
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer border-top">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>

    </div>

@endsection
