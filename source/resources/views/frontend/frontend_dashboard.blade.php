<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="robots" content="noindex, nofollow" />
    <title>@yield('title','Home')</title>

    <!-- Fav Icon -->
    <link rel="shortcut icon" href="{{ asset('upload/fevicon/fevicon.png') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link  href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{asset('frontend/assets/css/font-awesome-all.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/flaticon.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/owl.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/bootstrap.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/jquery.fancybox.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/jquery-ui.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/nice-select.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/color/theme-color.css')}}" id="jssDefault" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/timePicker.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/switcher-style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/toastr.css')}}" rel="stylesheet">

</head>


<!-- page wrapper -->

<body>

    <div class="boxed_wrapper">
        <!-- preloader -->
        @include('frontend.home.preload')
        <!-- preloader end -->

        {{--  <!-- switcher menu -->
          @include('frontend.home.switcher')
        <!-- end switcher menu -->  --}}

        <!-- main header -->
        @include('frontend.home.header')
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        @include('frontend.home.mobile_menu')
        <!-- End Mobile Menu -->

        @yield('main')

        <!-- main-footer -->
        @include('frontend.home.footer')
        <!-- main-footer end -->


        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>

    </div>


    <!-- jequery plugins -->
    <script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/owl.js')}}"></script>
    <script src="{{asset('frontend/assets/js/wow.js')}}"></script>
    <script src="{{asset('frontend/assets/js/validation.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.fancybox.js')}}"></script>
    <script src="{{asset('frontend/assets/js/appear.js')}}"></script>
    <script src="{{asset('frontend/assets/js/scrollbar.js')}}"></script>
    <script src="{{asset('frontend/assets/js/isotope.js')}}"></script>
   // <script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jQuery.style.switcher.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('frontend/assets/js/product-filter.js')}}"></script>
    <script src="{{asset('frontend/assets/js/timePicker.js')}}"></script>
    <script src="{{asset('frontend/assets/js/nav-tool.js')}}"></script>

    <!-- map script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
    <script src="{{ asset('frontend/assets/js/gmaps.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/map-helper.js') }}"></script>

    <!-- main-js -->
    <script src="{{asset('frontend/assets/js/script.js')}}"></script>
    <script src="{{asset('frontend/assets/js/toastr.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- dropdownLocation -->
    <script src="{{asset('frontend/assets/js/dropdownLocation.js')}}"></script>
    <script src="{{ asset('js/share.js') }}"></script>


    <!-- Toastr Seesion Message -->
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

        //Choose Image

        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            }
        })

        // Add To Wishlist
        function addToWishList(property_id){
            $.ajax({
            type: "POST",
            dataType: 'json',
            url: "/add-to-wishList/"+property_id,
            success:function(data){
                wishlist();
                // Start Message
            const Toast = Swal.mixin({
                  toast: true,
                  position: 'top-end',

                  showConfirmButton: false,
                  timer: 3000
            })
            if ($.isEmptyObject(data.error)) {

                    Toast.fire({
                    type: 'success',
                    icon: 'success',
                    title: data.success,
                    })
            }else{

           Toast.fire({
                    type: 'error',
                    icon: 'error',
                    title: data.error,
                    })
                }
              // End Message
            }
        })
        }


        //get currency symbol
        function currencySymbol() {
            $.ajax({
                type: "GET",
                url: "{{ route('currency.symbol') }}",
                success: function(response) {
                    var currency_symbol = response.currency_symbol;
                    // Update the price range slider with the received currency symbol
                    updatePriceRangeSlider(currency_symbol);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    // Handle errors, like displaying an error message to the user
                }
            });
        }

        currencySymbol();

        function updatePriceRangeSlider(currencySymbol) {
           //Price Range Slider
            $(".price-range-slider").slider({
                range: true,
                min: 0,
                max: 1000000,
                values: [1000, 30000],
                slide: function(event, ui) {
                    // Update text input with selected values
                    $(".property-amount").val(currencySymbol + ui.values[0] + " - "+currencySymbol + ui.values[1]);

                    // Update hidden input fields with selected values
                    $("#min-price").val(ui.values[0]);
                    $("#max-price").val(ui.values[1]);
                },
                // Trigger form submission when slider changes
                change: function(event, ui) {
                    $("#price-range-form").submit();
                }
            });

            // Set initial value for text input field
            $(".property-amount").val(currencySymbol + $(".price-range-slider").slider("values", 0) + " - "+currencySymbol + $(".price-range-slider").slider("values", 1));

        }



        // start load Wishlist Data
        function wishlist(){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-wishlist-property/",
                success:function(response){
                    if ($.isEmptyObject(response.wishlist)) {
                        // If there is no data, show a message
                        $('#wishlist').html('<div class="alert alert-info d-flex justify-content-center">No wishlist data available.</div>');
                        return;
                    }
                    $('#wishQty').text(response.wishQty);
                    var currency = response.currency;
                    console.log('currency'+response.currency);
                    var rows = "";
                    $.each(response.wishlist, function(key,value){
                        rows += `<div class="wrapper list">
                            <div class="deals-list-content list-item">
                                <div class="deals-block-one">
                                    <div class="inner-box">
                                        <div class="image-box">
                                            <figure class="image">
                                                <img src="/${value.property.property_thambnail}" alt="" style="height:350px;">
                                            </figure>
                                            <div class="batch"><i class="icon-11"></i></div>
                                            <span class="category">Featured</span>
                                            <div class="buy-btn">
                                                <a href="javascript:void(0)">For ${value.property.property_status} </a>
                                            </div>
                                        </div>
                                        <div class="lower-content">
                                            <div class="title-text"><h4><a href="/property/details/${value.property.id}/${value.property.property_slug}">${value.property.property_name}</a></h4></div>
                                            <div class="price-box clearfix">
                                                <div class="price-info pull-left">
                                                    <h6>Start From</h6>
                                                    <h4>${currency}${value.property.lowest_price} </h4>
                                                </div>
                                            </div>
                                            <p>${value.property.short_descp !== null && value.property.short_descp.length > 0 ? value.property.short_descp.substring(0, 105) + '...' : 'Short description'}</p>
                                            <ul class="more-details clearfix">
                                                <li><i class="icon-14"></i>${value.property.bedrooms} Beds</li>
                                                <li><i class="icon-15"></i>${value.property.bathrooms} Baths</li>
                                                <li><i class="icon-16"></i>${value.property.property_size} Sq Ft</li>
                                            </ul>
                                            <div class="other-info-box clearfix">
                                                <div class="btn-box pull-left">
                                                    <a href="/property/details/${value.property.id}/${value.property.property_slug}" class="theme-btn btn-two">
                                                        See Details
                                                    </a>
                                                </div>
                                                <ul class="other-option pull-right clearfix">
                                                    <li>
                                                        <a id="${value.id}" onclick="wishlistRemove(this.id)" ><i class="fa fa-trash"></i> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });
                    $('#wishlist').html(rows);
                }
            });
        }
        wishlist();

        // wishlist Remove Start
        function wishlistRemove(id){
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/wishlist-remove/"+id,
                success:function(data){
                    wishlist();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        });
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        });
                    }
                }
            });
        }
        // wishlist Remove end

        // Start Add to Compare
        function addToCompare(property_id){
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-compare/"+property_id,
                success:function(data){

                    // Start Message
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',

                    showConfirmButton: false,
                    timer: 3000
                })
                if ($.isEmptyObject(data.error)) {

                        Toast.fire({
                        type: 'success',
                        icon: 'success',
                        title: data.success,
                        })
                }else{

            Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title: data.error,
                        })
                    }
                // End Message
                }
            })
        }
        // End add to Compare

         // Load compare Data
         function compare() {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/get-compare-property/",
                success: function(response) {
                    // Access specific parts of the response as needed
                    var compare = response.compare;
                    var currencySymbol = response.currency;

                    var propertyArray = [];

                    // Iterate through each property and log it
                    $.each(compare, function(index, property) {
                        // Push property information into the array
                        propertyArray.push({
                            id: property.id,
                            thumbnail: property.property.property_thambnail,
                            name: property.property.property_name,
                            price: property.property.lowest_price,
                            bedrooms: property.property.bedrooms,
                            bathrooms: property.property.bathrooms,
                            propertySize: property.property.property_size,
                            garage: property.property.garage,
                            garageSize: property.property.garage_size,
                            propertyStatus: property.property.property_status,
                            address: property.property.address,
                            currency: currencySymbol
                        });
                    });

                    // Update the content of the element with id 'compare'
                    displayProperties(propertyArray, currencySymbol); // Pass currency symbol as a parameter
                },
                error: function(error) {
                    console.error("Error fetching compare data:", error);
                }
            });
        }

        // Function to display properties in columns
        function displayProperties(properties, currency) {
            if (properties.length === 0) {
                $('#compare').html('<div class="alert alert-info d-flex justify-content-center">No compare data available.</div>');
            } else {
                var row = '<table class="properties-table">' +
                    '<thead class="table-header">' +
                    '<tr>' +
                    '<th>Property Info</th>';

                properties.forEach(function(property) {
                    row += '<th>' +
                        '<figure class="image-box"><img src="/' + property.thumbnail + '" alt="' + property.thumbnail + '"></figure>' +
                        '<div class="title">' + property.name + '</div>' +
                        '<div class="price">' + property.currency + property.price + '</div>' + // corrected concatenation
                        '</th>';
                });

                row += '</tr></thead>' +
                    '<tbody>' +
                    '<tr>' +
                    '<td><p>Rooms</p></td>';

                properties.forEach(function(property) {
                    row += '<td><p>' + property.bedrooms + '</p></td>';
                });

                row += '</tr>' +
                    '<tr>' +
                    '<td><p>Bathrooms</p></td>';

                properties.forEach(function(property) {
                    row += '<td><p>' + property.bathrooms + '</p></td>';
                });

                row += '</tr>' +
                    '<tr>' +
                    '<td><p>Property Status</p></td>';

                properties.forEach(function(property) {
                    row += '<td><p> For ' + property.propertyStatus + '</p></td>';
                });

                row += '</tr>' +
                    '<tr>' +
                    '<td><p>Property Size</p></td>';

                properties.forEach(function(property) {
                    row += '<td><p>' + property.propertySize + ' Sq Ft</p></td>';
                });

                row += '</tr>' +
                    '<tr>' +
                    '<td><p>Garage</p></td>';

                properties.forEach(function(property) {
                    row += '<td><p>' + property.garage + '</p></td>';
                });

                row += '</tr>' +
                    '<tr>' +
                    '<td><p>Garage Size</p></td>';

                properties.forEach(function(property) {
                    row += '<td><p>' + property.garageSize + ' Sq Ft</p></td>';
                });

                row += '</tr>' +
                    '<tr>' +
                    '<td><p>Address</p></td>';

                properties.forEach(function(property) {
                    row += '<td><p>' + property.address + '</p></td>';
                });

                row += '</tr>' +
                    '<tr>' +
                    '<td><p>Action</p></td>';

                properties.forEach(function(property) {
                    row += '<td><a type="submit" class="action-btn" id="' + property.id + '" onclick="compareRemove(this.id)"><i class="fa fa-trash text-danger"></i></a></td>';
                });

                row += '</tr></tbody></table>';

                // Update the content of the element with id 'compare'
                $('#compare').html(row);
            }
        }




        // Call the compare() function when the page loads or as needed
        compare();

        // end load compare Data

        // Compare Remove Start
        function compareRemove(id) {
            $.ajax({
                type: "GET",
                dataType: 'json',
                url: "/compare-remove/" + id,
                success: function(data) {
                    compare();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success,
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error,
                        })
                    }
                    // End Message
                }
            })
        }
        // End Compare Remove

    </script>


</body>

</html>
