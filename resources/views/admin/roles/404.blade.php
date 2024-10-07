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
                                   <h2 class="fw-bold text-center lh-base">Tài khoản không đủ quyền truy cập</h2>
                                   <p class="text-muted text-center mt-1 mb-4">Tài khoản của bạn chưa đủ quyền truy cập chức năng này.</p>
                                   <div class="text-center">
                                        <a href="{{route('users.index')}}" class="btn btn-primary">Back To Home</a>
                                   </div>
                              </div>
                         </div>
                    </div>

                   
               </div>
          </div>
     </div>
@endsection