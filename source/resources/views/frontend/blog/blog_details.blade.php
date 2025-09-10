@extends('frontend.frontend_dashboard')
@section('title','Blog details')
@section('main')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->

<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-details sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-details-content">
                    <div class="news-block-one">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image">
                                    <img src="{{ asset($blog->post_image ?? '') }}" alt="">
                                </figure>
                                <span class="category">Featured</span>
                            </div>
                            <div class="lower-content">
                                <h3>{{ $blog->post_title ?? '' }}</h3>
                                <ul class="post-info clearfix">
                                    <li class="author-box">
                                        <figure class="author-thumb">
                                            <img src="{{ (!empty($blog->user->photo)) ? url('upload/admin_images/'.$blog->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                        </figure>
                                        <h5>
                                            <a href="javascript:void(0)">{{ $blog['user']['name'] ?? ''}}</a>
                                        </h5>
                                    </li>
                                    <li>{{ $blog->created_at->format('M d Y') ?? '' }}</li>
                                </ul>
                                <div class="text">
                                    <p>
                                        @isset($blog->long_descp)
                                            {!! $blog->long_descp !!}
                                        @else
                                            <!-- Handle the case where long description is not set -->
                                            <p>Long description is not available.</p>
                                        @endisset
                                    </p>
                                </div>
                                <div class="post-tags">
                                    <ul class="tags-list clearfix">
                                        <li>
                                            <h5>Tags:</h5>
                                        </li>
                                        @foreach($tags_all as $tag)
                                        <li><a href="{{ url('blog/tag/'.$tag) }}">{{ ucwords($tag) ?? '' }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @php
                    $comment = App\Models\Comment::where('post_id',$blog->id)->where('parent_id',null)->get();
                    @endphp
                    <div class="comments-area">
                        <div class="group-title">
                            <h4>{{ count($comment) }} Comments</h4>
                        </div>
                        <div class="comment-box">
                            @foreach($comment as $com)
                            <div class="comment">
                                <figure class="thumb-box">
                                    <img  src="{{ (!empty($com->user->photo)) ? url('upload/user_images/'.$com->user->photo) : url('upload/no_image.jpg') }}" style="width: 50px; height: 50px;" alt="">
                                </figure>
                                <div class="comment-inner">
                                    <div class="comment-info clearfix">
                                        <h5>{{ $com->user->name }}</h5>
                                        <span>{{ $com->created_at->format('M d Y') }}</span>
                                    </div>
                                    <div class="text">
                                        <p>{{ $com->subject }}</p>
                                        <p>{{ $com->message }}</p>
                                        <a href="javascript:void(0)"><i class="fas fa-share"></i>Reply</a>
                                    </div>
                                </div>
                            </div>

                            @php
                            $reply = App\Models\Comment::where('parent_id',$com->id)->get();
                            @endphp

                            @foreach($reply as $rep)
                            <div class="comment replay-comment">
                                <figure class="thumb-box">
                                    <img  src="{{ (!empty($rep->user->photo)) ? url('upload/admin_images/'.$rep->user->photo) : url('upload/no_image.jpg') }}" style="width: 50px; height: 50px;" alt="">
                                </figure>
                                <div class="comment-inner">
                                    <div class="comment-info clearfix">
                                        <h5>{{ $rep->user->name }}</h5>
                                        <span>{{ $rep->created_at->format('M d Y') }}</span>
                                    </div>
                                    <div class="text">
                                        <p>{{ $rep->message }}</p>
                                        <a href="javascript:void(0)"><i class="fas fa-share"></i>Reply</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endforeach

                        </div>
                    </div>
                    <div class="comments-form-area">
                        <div class="group-title">
                            <h4>Leave a Comment</h4>
                        </div>
                        @auth
                        <form action="{{ route('store.comment') }}" method="post" class="comment-form default-form">
                            @csrf
                            <input type="hidden" name="post_id" value="{{ $blog->id }}">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <input type="text" name="subject" placeholder="Subject" required="">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                                    <textarea name="message" placeholder="Your message"></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-group message-btn">
                                    <button type="submit" class="theme-btn btn-one">Submit Now</button>
                                </div>
                            </div>
                        </form>
                        @else
                            <p>
                                <b>
                                    For Add Comment You need to login first <a href="{{ route('login')}}"> Login Here </a>
                                </b>
                            </p>
                        @endauth
                    </div>
                </div>
            </div>
            <!-- sidebar-page-container -->
            @include('frontend.blog.blog_sidebar')
            <!-- sidebar-page-container -->
        </div>
    </div>
</section>
<!-- sidebar-page-container -->
<!-- subscribe-section -->
@include('frontend.dashboard.subscribe')
<!-- subscribe-section end -->
@endsection
