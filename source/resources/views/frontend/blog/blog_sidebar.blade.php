<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="blog-sidebar">
        <div class="sidebar-widget search-widget">
            <div class="widget-title">
                <h4>Search</h4>
            </div>
            <div class="search-inner">
                <form  action="{{ route('blog.list') }}" method="get">
                    @csrf
                    <div class="form-group">
                        <input type="search" name="search_field" id="search_field" placeholder="Search Blog" required="">
                        <button type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="sidebar-widget social-widget">
            <div class="widget-title">
                <h4>Follow Us On</h4>
            </div>
            <ul class="social-links clearfix">
                <li><a href="{{ $sitesetting->facebook ?? ''}}"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="{{ $sitesetting->youtube ?? ''}}"><i class="fab fa-youtube"></i></a></li>
                <li><a href="{{ $sitesetting->twitter ?? ''}}"><i class="fab fa-twitter"></i></a></li>
                <li><a href="{{ $sitesetting->instagram ?? ''}}"><i class="fab fa-instagram"></i></a></li>
            </ul>
        </div>
        <div class="sidebar-widget category-widget">
            <div class="widget-title">
                <h4>Category</h4>
            </div>
            <div class="widget-content">
                <ul class="category-list clearfix">
                    @forelse($bcategory as $cat)
                    @php
                    $post = App\Models\BlogPost::where('blogcat_id',$cat->id)->get();
                    $encryptedId = encrypt($cat->id);
                    @endphp
                    <li>
                        <a href="{{ url('blog/cat/list/'.$encryptedId) }}">{{ $cat->category_name ?? '' }}
                            <span>({{count($post) ?? '' }})</span>
                        </a>
                    </li>
                    @empty
                    <div class="alert alert-info text-center">
                        No category found.
                    </div>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="sidebar-widget post-widget">
            <div class="widget-title">
                <h4>Recent Posts</h4>
            </div>
            <div class="post-inner">
                @forelse($dpost as $post)
                <div class="post">
                    <figure class="post-thumb">
                        <a href="javascript:void(0)">
                            <img src="{{ asset($post->post_image ?? '') }}" alt="">
                        </a>
                    </figure>
                    <h5>
                        <a href="{{ url('blog/details/'.$post->post_slug) }}">{{ $post->post_title ?? ''}}</a>
                    </h5>
                    <span class="post-date">{{ $post->created_at->format('M d Y') ?? "" }}</span>
                </div>
                @empty
                <div class="alert alert-info text-center">
                    No recent post found.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
