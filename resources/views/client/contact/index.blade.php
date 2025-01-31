@extends('client.layouts.main')

@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="{{ asset('theme/client/assets/img/photos/bg3.webp') }}">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-content">
                        <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Contact Us</h2>
                        <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="breadcrumb-sep">//</li>
                                <li>Contact Us</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Contact Area Wrapper ==-->
    <section class="contact-area contact-page-area">
        <div class="container">
            <div class="row contact-page-wrapper">
                <div class="col-xl-9">
                    <div class="contact-form-wrap" data-aos="fade-right">
                        <div class="contact-form-title">
                            <h2 class="title">We Are Here! <br>Please Send A Quest</h2>
                        </div>
                        <!--== Start Contact Form ==-->
                        <div class="contact-form">
                            <form id="contact-form" action="{{ route('contact.store') }}"
                                  method="POST">
                                @csrf
                                <div class="row row-gutter-20">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control @error('name') border-danger @enderror"
                                                   type="text" name="name"
                                                   value="{{ old('name') }}"
                                                   placeholder="Name *">
                                            <span class="error-notification">
                                                @error('name')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="form-control @error('email') border-danger @enderror"
                                                   type="email" name="email"
                                                   value="{{ old('email') }}"
                                                   placeholder="Email *">
                                            <span class="error-notification">
                                                @error('email')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input class="form-control @error('phone') border-danger @enderror"
                                                   name="phone" type="text"
                                                   value="{{ old('phone') }}"
                                                   placeholder="Phone">
                                            <span class="error-notification">
                                                @error('phone')
                                                {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group mb--0">
                                                <textarea class="form-control @error('message') border-danger @enderror"
                                                          name="message"
                                                          placeholder="Message">
                                                    {!! old('message') !!}
                                                </textarea>
                                            <span class="error-notification">
                                                @error('message')
                                                {{ $message }}
                                                @enderror
                                            </span>
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
                        <div class="form-message"></div>
                        <div class="shape-group-style2">
                            <div class="shape-group-one"><img src="{{ asset('theme/client/assets/img/shape/13.webp') }}"
                                                              width="193"
                                                              height="168" alt="Image-HasTech"></div>
                            <div class="shape-group-two"><img src="{{ asset('theme/client/assets/img/shape/15.webp') }}"
                                                              width="221"
                                                              height="113" alt="Image-HasTech"></div>
                            <div class="shape-group-three"><img
                                    src="{{ asset('theme/client/assets/img/shape/16.webp') }}" width="129"
                                    height="147" alt="Image-HasTech"></div>
                            <div class="shape-group-four"><img
                                    src="{{ asset('theme/client/assets/img/shape/17.webp') }}" width="493"
                                    height="340" alt="Image-HasTech"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3">
                    <div class="contact-info-wrap">
                        <div class="contact-info">
                            <div class="row">
                                <div class="col-lg-4 col-xl-12">
                                    <div class="info-item" data-aos="fade-left">
                                        <div class="icon">
                                            <img src="{{ asset('theme/client/assets/img/icons/c1.webp') }}" width="69"
                                                 height="65"
                                                 alt="Image-HasTech">
                                        </div>
                                        <div class="info">
                                            <h5 class="title">Address</h5>
                                            <p>Your address goes here. 123 Your Location</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-xl-12">
                                    <div class="info-item" data-aos="fade-left" data-aos-delay="60">
                                        <div class="icon">
                                            <img src="{{ asset('theme/client/assets/img/icons/c2.webp') }}" width="65"
                                                 height="65"
                                                 alt="Image-HasTech">
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
                                    <div class="info-item" data-aos="fade-left" data-aos-delay="120">
                                        <div class="icon">
                                            <img src="{{ asset('theme/client/assets/img/icons/c3.webp') }}" width="65"
                                                 height="65"
                                                 alt="Image-HasTech">
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
                </div>
            </div>
        </div>
    </section>
    <!--== End Contact Area Wrapper ==-->
@endsection
