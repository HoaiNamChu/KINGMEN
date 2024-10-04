@extends('admin.layouts.main')


@section('content')
<div class="wrapper">

    <!-- ========== Topbar Start ========== -->
    <!-- Activity Timeline -->
    <!-- Right Sidebar (Theme Settings) -->
    <!-- ========== Topbar End ========== -->

    <!-- ========== App Menu Start ========== -->

    <!-- ========== App Menu End ========== -->

    <!-- ==================================================== -->
    <!-- Start right Content here -->
    <!-- ==================================================== -->
    <div class="page-content">

        <!-- Start Container Fluid -->
        <div class="container-xxl">

            <div class="row">

                <div class="col-xl-9 col-lg-8 ">
                 
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Update Role</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form action="{{route('roles.update', $role->id)}}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                    <div class="col-lg-12">

                                        <div class="mb-3">
                                            <label for="category-title" class="form-label">Role Name</label>
                                            <input type="text" name="name" id="" class="form-control"
                                                placeholder="Enter Title" value="{{ old('name', $role->name) }}" required>
                                        </div>

                                    </div>

                                                  
                                    <div class="col-lg-12">
                                        <div class="mb-0">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control bg-light-subtle" name="description" id="" rows="7"
                                                placeholder="Type description" required>{{$role->description}}</textarea>
                                        </div>
                                    </div>
                                        <br>
                                    <div class="p-3 bg-light mb-3 rounded">
                                        <div class="row justify-content-end g-2">
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-outline-secondary w-100">Save Change</button>
                                            </div>
                                            <div class="col-lg-2">
                                                <a href="{{route('roles.index')}}" class="btn btn-primary w-100">Cancel</a>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- card 
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Meta Options</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-lg-6">
                                                  
                                                       <div class="mb-3">
                                                            <label for="meta-title" class="form-label">Meta Title</label>
                                                            <input type="text" id="meta-title" class="form-control" placeholder="Enter Title">
                                                       </div>
                                                  
                                             </div>
                                             <div class="col-lg-6">
                                                  
                                                       <div class="mb-3">
                                                            <label for="meta-tag" class="form-label">Meta Tag Keyword</label>
                                                            <input type="text" id="meta-tag" class="form-control" placeholder="Enter word">
                                                       </div>
                                                  
                                             </div>
                                             <div class="col-lg-12">
                                                  <div class="mb-0">
                                                       <label for="description" class="form-label">Description</label>
                                                       <textarea class="form-control bg-light-subtle" id="description" rows="4" placeholder="Type description"></textarea>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div> -->

                </div>
            </div>

        </div>
        <!-- End Container Fluid -->

        <!-- ========== Footer Start ========== -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 text-center">
                        <script>document.write(new Date().getFullYear())</script> &copy; Larkon. Crafted by
                        <iconify-icon icon="iconamoon:heart-duotone"
                            class="fs-18 align-middle text-danger"></iconify-icon> <a href="#"
                            class="fw-bold footer-text" target="_blank">Techzaa</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ========== Footer End ========== -->

    </div>
    <!-- ==================================================== -->
    <!-- End Page Content -->
    <!-- ==================================================== -->


</div>
@endsection