@extends('client.layouts.main')

@section('content')

@if (session('error'))
  <div class="alert alert-danger">
    {{ session('error') }}
  </div>
@endif


<section class="contact-area contact-page-area">
  <div class="container">
    <div class="row contact-page-wrapper">
      <div class="col-xl-9">
        <div class="contact-form-wrap" data-aos="fade-right">
          <div class="contact-form-title">
            <h2 class="title">We Are Here! <br>Please Send A Ticket</h2>
          </div>
          <!--== Start Contact Form ==-->
          <div class="contact-form">
            <form id="contact-form" action="{{route('tickets.store')}}" method="POST">
            @csrf
              <div class="row row-gutter-20">

                <div class="col-12">
                  <div class="form-group">
                    <input class="form-control" type="text" name="subject" placeholder="Subject (Optinal)">
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group mb--0">
                    <textarea class="form-control" name="message" placeholder="Message"></textarea>
                  </div>
                </div>
                <div class="col-12">
                  <div class="form-group mb--0">
                    <button class="btn-theme" type="submit">Send Message</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
          <!--== End Contact Form ==-->

          <!--== Message Notification ==-->

        </div>
      </div>
      <!-- <div class="col-xl-3">
            <div class="contact-info-wrap">
              <div class="contact-info">
                <div class="row">
                  <div class="col-lg-4 col-xl-12">
                    <div class="info-item"  data-aos="fade-left">
                      <div class="icon">
                        <img src="assets/img/icons/c1.webp" width="69" height="65" alt="Image-HasTech">
                      </div>
                      <div class="info">
                        <h5 class="title">Address</h5>
                        <p>Your address goes here. 123 Your Location</p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-xl-12">
                    <div class="info-item"  data-aos="fade-left" data-aos-delay="60">
                      <div class="icon">
                        <img src="assets/img/icons/c2.webp" width="65" height="65" alt="Image-HasTech">
                      </div>
                      <div class="info">
                        <h5 class="title">Phone No</h5>
                        <p>
                          <a href="tel://+00123456789">+00123456789</a><br>
                          <a href="tel://+00123456789">+00123456789</a>
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4 col-xl-12">
                    <div class="info-item"  data-aos="fade-left" data-aos-delay="120">
                      <div class="icon">
                        <img src="assets/img/icons/c3.webp" width="65" height="65" alt="Image-HasTech">
                      </div>
                      <div class="info">
                        <h5 class="title">Email / Web</h5>
                        <p>
                          <a href="mailto://demo@example.com">demo@example.com</a><br>
                          <a href="mailto://www.example.com">www.example.com</a>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
    </div>
  </div>
</section>

@endsection