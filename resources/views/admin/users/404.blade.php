@extends('admin.layouts.main')


@section('content')
<div class="d-flex flex-column h-100 p-3">
          <div class="d-flex flex-column flex-grow-1">
               <div class="row h-100">
                    <div class="col-xxl-7">
                         <div class="row align-items-center justify-content-center h-100">
                              <div class="col-lg-10">
                             
                                   <div class="mx-auto text-center">
                                        <img src="assets/images/404-error.png" alt="" class="img-fluid my-3">
                                   </div>
                                   <h2 class="fw-bold text-center lh-base">Tài Khoản không đủ quyền truy cập</h2>
                                   <p class="text-muted text-center mt-1 mb-4">Sorry, we couldn't find the page you were looking for. We suggest that you return to main sections</p>
                                   <div class="text-center">
                                        <a href="index-2.html" class="btn btn-primary">Back To Home</a>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <div class="col-xxl-5 d-none d-xxl-flex">
                         <div class="card h-100 mb-0 overflow-hidden">
                              <div class="d-flex flex-column h-100">
                                   <img src="assets/images/small/img-10.jpg" alt="" class="w-100 h-100">
                              </div>
                         </div> <!-- end card -->
                    </div>
               </div>
          </div>
     </div>
@endsection