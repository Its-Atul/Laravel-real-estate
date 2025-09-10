@php
    $cname = App\Models\SiteSetting::find('1');
    @endphp
<footer
class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
<p class="text-muted mb-1 mb-md-0">Copyright © {{ date("Y") }} <a href="{{$cname->website }}"
        target="_blank">{{ $cname->company_name }}</a>.</p>
<p class="text-muted">{{ $cname->company_name }} With <i class="mb-1 text-primary ms-1 icon-sm"
        data-feather="heart"></i></p>
</footer>
