<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Your real estate website description goes here">
    <meta name="author" content="Your Name">
    <meta name="keywords" content="real estate, property, buy, sell, rent">
    <meta name="robots" content="noindex, nofollow" />
    <!-- End meta tags -->

    <title>@yield('title','Admin Panel')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/select2/select2.min.css') }}">
    <!-- End Select2 CSS -->

    <!-- jQuery Tags Input CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <!-- End jQuery Tags Input CSS -->

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End DataTables CSS -->

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/core/core.css') }}">
    <!-- End Core CSS -->

    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End Flatpickr CSS -->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/demo2/style.css') }}">
    <!-- End Custom CSS -->

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('upload/fevicon/fevicon.png') }}" />

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/toastr.css') }}">
    <!-- End Toastr CSS -->

    <!-- Bootstrap Toggle CSS -->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-toggle.min.css') }}">
    <!-- End Bootstrap Toggle CSS -->
</head>

<body>
    <div class="main-wrapper">
        <!-- Sidebar -->
        @include('admin.body.sidebar')
        <!-- End Sidebar -->

        <div class="page-wrapper">
            <!-- Navbar -->
            @include('admin.body.header')
            <!-- End Navbar -->

            @yield('admin')

            <!-- Footer -->
            @include('admin.body.footer')
            <!-- End Footer -->
        </div>
    </div>

    <!-- Core JS -->
    <script src="{{ asset('backend/assets/vendors/core/core.js') }}"></script>
    <!-- End Core JS -->

    <!-- Flatpickr JS -->
    <script src="{{ asset('backend/assets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <!-- End Flatpickr JS -->

    <!-- Feather Icons JS -->
    <script src="{{ asset('backend/assets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/template.js') }}"></script>
    <!-- End Feather Icons JS -->

    <!-- Custom Dashboard JS -->
    <script src="{{ asset('backend/assets/js/dashboard-dark.js') }}"></script>
    <!-- End Custom Dashboard JS -->

    <!-- Toastr JS -->
    <script src="{{ asset('backend/assets/js/toastr.min.js') }}"></script>
    <script>
        @if(Session::has('message'))
            var type = "{{ Session::get('alert-type','info') }}"
            switch(type){
                case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

                case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

                case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

                case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
            }
        @endif
    </script>
    <!-- End Toastr JS -->

    <!-- SweetAlert JS -->
    <script src="{{ asset('backend/assets/js/sweetalert.js') }}"></script>
    <!-- End SweetAlert JS -->

    <!-- Validation JS -->
    <script src="{{ asset('backend/assets/js/code/code.js') }}"></script>
    <script src="{{ asset('backend/assets/js/code/validate.min.js') }}"></script>
    <!-- End Validation JS -->

    <!-- DataTables JS -->
    <script src="{{ asset('backend/assets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('backend/assets/js/data-table.js') }}"></script>
    <!-- End DataTables JS -->

    <!-- Input Tags -->
    <script src="{{ asset('backend/assets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('backend/assets/js/select2.js') }}"></script>
    <script src="{{ asset('backend/assets/js/typeahead.js') }}"></script>
    <script src="{{ asset('backend/assets/js/tags-input.js') }}"></script>
    <script src="{{ asset('backend/assets/js/code/bootstrap-toggle.min.js') }}"></script>
    <!-- End Input Tags -->

    <!-- TinyMCE JS -->
    <script src="{{ asset('backend/assets/vendors/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/tinymce.js') }}"></script>
    <!-- End TinyMCE JS -->
</body>
</html>
