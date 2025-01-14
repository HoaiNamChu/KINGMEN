@extends('client.layouts.main')


@section('content')
    <!--== Start Page Header Area Wrapper ==-->
    <div class="page-header-area" data-bg-img="{{ asset('theme/client/assets/img/photos/bg3.webp') }}">
        <div class="container pt--0 pb--0">
            <div class="row">
                <div class="col-12">
                    <div class="page-header-content">
                        <h2 class="title" data-aos="fade-down" data-aos-duration="1000">Blog Details</h2>
                        <nav class="breadcrumb-area" data-aos="fade-down" data-aos-duration="1200">
                            <ul class="breadcrumb">
                                <li><a href="index.html">Home</a></li>
                                <li class="breadcrumb-sep">//</li>
                                <li>Blog Details</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== End Page Header Area Wrapper ==-->

    <!--== Start Blog Area Wrapper ==-->
    <section class="blog-details-area">
        <div class="container pb-lg-85">
            <div class="row justify-content-center">
                <div class="col-lg-11" data-aos="fade-up">
                    <div class="blog-details-content-wrap">
                        <div class="blog-details-item">
                            <div class="blog-details-thumb">
                                <img src="{{ Storage::url($post->image) }}" width="750" height="459"
                                     alt="Image-HasTech">
                            </div>
                            <div class="blog-meta-post">
                                <ul>
                                    <li class="post-date"><i class="fa fa-calendar"></i><a href="blog.html">{{ $post->created_at }}</a></li>
                                    <li class="author-info"><i class="fa fa-user"></i><a href="blog.html">{{ $post->user->name ?? $post->user->username }}</a></li>
                                </ul>
                            </div>
                            <h3 class="main-title">{{ $post->title }}</h3>
                            <div class="details-wrapper">
                                {!! $post->content !!}
                            </div>
{{--                            <div class="details-wrapper details-wrapper-style1" data-margin-bottom="38">--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor--}}
{{--                                    incididunt ut labore eto dolore magna aliqua. Ut enim ad minim veniam, quis--}}
{{--                                    nostrud exercitation ullamcol laboris nisi ut aliquipp ex ea commodo consequat.--}}
{{--                                    Duis aute irure dolor in reprehenderit inloifk voluptate velit esse cillum--}}
{{--                                    dolore eu fugiat nulla pariatur. Excepteur sint occaec cupidatat non proident,--}}
{{--                                    sunt in culpa qui officia deserunt mollit anim id est laborum.</p>--}}
{{--                                <blockquote>--}}
{{--                                    <div class="inner-content">--}}
{{--                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting--}}
{{--                                            industry. has been the industry's standard dummy text</p>--}}
{{--                                        <span class="user-name">Rachel Leonard</span>--}}
{{--                                        <img class="inner-shape" src="assets/img/icons/quote2.webp" width="82"--}}
{{--                                             height="59" alt="Image-HasTech">--}}
{{--                                    </div>--}}
{{--                                </blockquote>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor--}}
{{--                                    incididunt ut labore eto dolore magna aliqua. Ut enim ad minim veniam, quis--}}
{{--                                    nostrud exercitation ullamcol laboris nisi ut aliquipp ex ea commodo consequat.--}}
{{--                                    Duis aute irure dolor in reprehenderit inloifk voluptate velit esse cillum--}}
{{--                                    dolore eu fugiat nulla pariatur.</p>--}}
{{--                            </div>--}}
{{--                            <div class="details-wrapper details-wrapper-style2">--}}
{{--                                <p><img class="p-image-right" src="assets/img/blog/details2.webp" width="370"--}}
{{--                                        height="400" alt="Image-HasTech"><span>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, whenan unknown printer took a galley of type and scrambled it to make a type tun tuni is specimen book. It has survived not only five centuries, but also the leap into tuna electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing</span>--}}
{{--                                </p>--}}
{{--                                <p> leu fugiat nulla pariatur. Excepteur sintocca cupidatat non proident, sunt in--}}
{{--                                    culpa qui off deserunt mollit anim id est laborum. Sed utl perspiciatis unde--}}
{{--                                    omnis iste natus error sit voluptatem accusantium</p>--}}
{{--                                <p class="mb-25"> leu fugiat nulla pariatur. Excepteur sintocca cupidatat non--}}
{{--                                    proident, sunt in culpa qui off deserunt mollit anim id est laborum. Sed utl--}}
{{--                                    perspiciatis unde omnis iste natus error sit voluptatem accusantium</p>--}}
{{--                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor--}}
{{--                                    incididunt ut labore eto dolore magna aliqua. Ut enim ad minim veniam, quis--}}
{{--                                    nostrud exercitation ullamcol laboris nisi ut aliquipp ex ea commodo consequat.--}}
{{--                                    Duis aute irure dolor in reprehenderit inloifk voluptate velit esse cillum--}}
{{--                                    dolore eu fugiat nulla pariatur.</p>--}}
{{--                            </div>--}}
                            <div class="blog-details-footer">
                                <div class="tage-list">
                                    <span>Tages:</span>
                                    <a href="blog.html">Mobile</a>,
                                    <a href="blog.html">Laptop</a>,
                                    <a href="blog.html">Smart</a>,
                                    <a href="blog.html">TV</a>
                                </div>
                                <div class="social-icons">
                                    <span>Share:</span>
                                    <a href="#/"><i class="fa fa-facebook"></i></a>
                                    <a href="#/"><i class="fa fa-dribbble"></i></a>
                                    <a href="#/"><i class="fa fa-pinterest-p"></i></a>
                                    <a href="#/"><i class="fa fa-twitter"></i></a>
                                </div>
                            </div>
                            <div class="article-next-previous">
                                <div class="arrow-item previous">
                                    <div class="arrow-thumb">
                                        <a href="blog-details.html"><img src="assets/img/blog/s4.webp" width="98"
                                                                         height="101" alt=""></a>
                                        <a class="overlay" href="blog-details.html"><i class="fa fa-angle-left"></i></a>
                                    </div>
                                    <div class="arrow-content">
                                        <span class="date"><a href="blog.html"><i class="fa fa-calendar"></i>26 March, 2022</a></span>
                                        <h6 class="title"><a href="blog-details.html">Lorem ipsum dolorl amet conse
                                                adip</a></h6>
                                    </div>
                                </div>
                                <div class="arrow-item next">
                                    <div class="arrow-thumb">
                                        <a href="blog-details.html"><img src="assets/img/blog/s1.webp" width="98"
                                                                         height="101" alt=""></a>
                                        <a class="overlay" href="blog-details.html"><i
                                                class="fa fa-angle-right"></i></a>
                                    </div>
                                    <div class="arrow-content">
                                            <span class="date"><a href="blog.html">25 March, 2022<i
                                                        class="fa fa-calendar"></i></a></span>
                                        <h6 class="title"><a href="blog-details.html">Lorem ipsum dolorl amet conse
                                                adip</a></h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!--== Start Comment View Item ==-->
                        <div class="comment-view-area">
                            <h4 class="title-main">Comments</h4>
                            <div class="comment-view-content">
                                <div class="single-comment">
                                    <div class="author-pic">
                                        <a href="blog.html"><img src="assets/img/blog/author1.webp" width="101"
                                                                 height="118" alt="Image-HasTech"></a>
                                    </div>
                                    <div class="author-info">
                                        <h4 class="title">
                                            <a href="blog.html">Marie Jensen</a>
                                            <span> - </span>
                                            <a class="comment-date" href="blog.html">22 August, 2022</a>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore eto magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamcol</p>
                                        <div class="author-info-footer">
                                            <a class="comment-reply" href="#/">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-comment reply-comment">
                                    <div class="author-pic">
                                        <a href="blog.html"><img src="assets/img/blog/author2.webp" width="101"
                                                                 height="118" alt="Image-HasTech"></a>
                                    </div>
                                    <div class="author-info">
                                        <h4 class="title">
                                            <a href="blog.html">Rachel Leonard</a>
                                            <span> - </span>
                                            <a class="comment-date" href="blog.html">22 August, 2022</a>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore eto magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamcol</p>
                                        <div class="author-info-footer">
                                            <a class="comment-reply" href="#/">Reply</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-comment">
                                    <div class="author-pic">
                                        <a href="blog.html"><img src="assets/img/blog/author3.webp" width="101"
                                                                 height="118" alt="Image-HasTech"></a>
                                    </div>
                                    <div class="author-info">
                                        <h4 class="title">
                                            <a href="blog.html">Amilia Luna</a>
                                            <span> - </span>
                                            <a class="comment-date" href="blog.html">22 August, 2022</a>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                            tempor incididunt ut labore eto magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamcol</p>
                                        <div class="author-info-footer">
                                            <a class="comment-reply" href="#/">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--== End Comment View Item ==-->

                        <!--== Start Comment Item ==-->
                        <div class="comment-form-area">
                            <h4 class="title-main">Leave a Comments</h4>
                            <div class="comment-form-content">
                                <form action="#">
                                    <div class="row ">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input class="form-control" type="text" placeholder="Name *">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input class="form-control" type="email" placeholder="Email *">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input class="form-control" type="text"
                                                       placeholder="Subject (Optinal)">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb--0">
                                                <textarea class="form-control" placeholder="Message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group mb--0">
                                                <button type="submit" class="btn-theme">Send a Comment</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!--== End Comment Item ==-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== End Blog Area Wrapper ==-->
@endsection
