@extends('frontend.frontend_dashboard')
@section('main')
@section('title','Blog list')
<!--Page Title-->
@include('frontend.home.page_title')
<!--End Page Title-->


<!-- sidebar-page-container -->
<section class="sidebar-page-container blog-grid sec-pad-2">
    <div class="auto-container">
        <div class="row clearfix">
            <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                <div class="blog-grid-content">
                    <div class="row clearfix">
                        @forelse($blog as $item)
                        <div class="col-lg-6 col-md-6 col-sm-12 news-block">
                            <div class="news-block-one wow fadeInUp animated" data-wow-delay="00ms"
                                data-wow-duration="1500ms">
                                <div class="inner-box">
                                    <div class="image-box">
                                        <figure class="image">
                                            <a href="{{ url('blog/details/'.$item->post_slug) }}">
                                                <img src="{{ asset($item->post_image) }}" alt=""></a>
                                            </figure>
                                        <span class="category">Featured</span>
                                    </div>
                                    <div class="lower-content">
                                        <h4>
                                            <a href="{{ url('blog/details/'.$item->post_slug) }}">{{ (strlen($item->post_title) > 28) ? substr($item->post_title, 0, 28). '...' : ($item->post_title ? $item->post_title : 'Blog title' ) }}</a>
                                        </h4>
                                        <ul class="post-info clearfix">
                                            <li class="author-box">
                                                <figure class="author-thumb">
                                                    <img src="{{ (!empty($item->user->photo)) ? url('upload/admin_images/'.$item->user->photo) : url('upload/no_image.jpg') }}" alt="">
                                                </figure>
                                                <h5>
                                                    <a href=" ">{{ $item['user']['name'] ?? ''  }}</a>
                                                </h5>
                                            </li>
                                            <li>{{ $item->created_at->format('M d Y') ?? '' }}</li>
                                        </ul>
                                        <div class="text">
                                            <p>{{ (strlen($item->short_descp) > 108) ? substr($item->short_descp, 0, 108). '....' : ($item->short_descp ? $item->short_descp : 'Short description') }}</p>
                                        </div>
                                        <div class="btn-box">
                                            <a href="{{ url('blog/details/'.$item->post_slug) }}" class="theme-btn btn-two">See Details</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="alert alert-info">
                            No Blog found.
                        </div>
                        @endforelse
                    </div>
                    <div class="pagination-wrapper">
                        {{ $blog->links('vendor.pagination.custom') }}
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
