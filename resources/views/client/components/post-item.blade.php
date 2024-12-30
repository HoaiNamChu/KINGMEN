<div class="col-md-6 col-lg-4">
    <!--== Start Blog Item ==-->
    <div class="post-item">
        <div class="inner-content">
            <div class="thumb">
                <a href="{{ route('client.posts.detail',$item->slug) }}"><img src="{{ Storage::url($item->image) }}" width="370"
                                                 height="260" alt="Image-HasTech"></a>
            </div>
            <div class="content">
                <div class="meta-post">
                    <ul>
                        <li class="post-date"><i class="fa fa-calendar"></i><a href="blog.html">{{ $item->created_at }}</a></li>
                        <li class="author-info"><i class="fa fa-user"></i><a href="blog.html">{{ $item->user->name ?? $item->user->username }}</a></li>
                    </ul>
                </div>
                <h4 class="title"><a href="{{ route('client.posts.detail',$item->slug) }}">{{ $item->title }}</a></h4>
                <a class="post-btn" href="{{ route('client.posts.detail',$item->slug) }}">Read More</a>
            </div>
        </div>
    </div>
    <!--== End Blog Item ==-->
</div>
