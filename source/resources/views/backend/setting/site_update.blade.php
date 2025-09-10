@extends('admin.admin_dashboard')
@section('title','Site Setting')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Update Site Setting </h6>
                        <form id="myForm" method="POST" action="{{ route('update.site.setting') }}" class="forms-sample" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{ $sitesetting->id ?? '' }}">
                            <div class="form-group mb-3">
                                <label for="company_name" class="form-label">Name <span>*</span></label>
                                <input type="text" name="company_name" id="company_name" class="form-control @error('company_name') is-invalid @enderror"
                                    value="{{ $sitesetting->company_name ?? '' }}" placeholder="Enter company name">
                                @error('company_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="email" class="form-label"> Email <span>*</span></label>
                                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ $sitesetting->email ?? '' }}" placeholder="Enter company email address">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="support_phone" class="form-label">Phone <span>*</span></label>
                                <input type="text" name="support_phone" id="support_phone" class="form-control  @error('support_phone') is-invalid @enderror"
                                    value="{{ $sitesetting->support_phone ?? '' }}" placeholder="Enter phone number (e.g., 1234567890)">
                                @error('support_phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="company_address" class="form-label">Address <span>*</span></label>
                                <textarea name="company_address" id="company_address" class="form-control  @error('company_address') is-invalid @enderror"
                                    rows="3" placeholder="Enter company address">{{ $sitesetting->company_address ?? ''}}</textarea>
                                @error('company_address')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="about" class="form-label">About <span>*</span></label>
                                <textarea name="about" id="about" class="form-control  @error('about') is-invalid @enderror" rows="3" placeholder="Enter a brief description about your company">{{ $sitesetting->about ?? ''}}</textarea>
                                @error('about')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group mb-3">
                                <label for="latitude" class="form-label">Latitude <span>*</span></label>
                                <input type="text" name="latitude" id="latitude" class="form-control @error('latitude') is-invalid @enderror"
                                    value="{{ $sitesetting->latitude ?? '' }}" placeholder="Enter latitude (e.g., 40.7128)">
                                <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Latitude from address</a>
                                @error('latitude')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="longitude" class="form-label">Longitude <span>*</span></label>
                                <input type="text" name="longitude" id="longitude" class="form-control @error('longitude') is-invalid @enderror"
                                    value="{{ $sitesetting->longitude ?? '' }}" placeholder="Enter longitude (e.g., -74.0060)">
                                <a href="https://www.latlong.net/convert-address-to-lat-long.html" target="_blank">Go here to get Longitude from address</a>
                                @error('longitude')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="open_timming" class="form-label">Opening Time <span>*</span></label>
                                <input type="text" name="open_timming" id="open_timming" class="form-control @error('open_timming') is-invalid @enderror"
                                    value="{{ $sitesetting->open_timming ?? '' }}" placeholder="Enter opening time (e.g., Mon - Sat 9.00 - 18.00)">
                                @error('open_timming')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="open_timming" class="form-label">Currency Symbol <span>*</span></label>
                                <input type="text" name="currency_symbol" id="currency_symbol" class="form-control @error('currency_symbol') is-invalid @enderror"
                                    value="{{ $sitesetting->currency_symbol ?? '' }}" placeholder="Enter currency symbol (e.g., $)">
                                @error('currency_symbol')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{--  header logo  --}}
                            <div class="form-group mb-3">
                                <label for="logo" class="form-label">Top header logo <span>*</span></label>
                                <input class="form-control  @error('logo') is-invalid @enderror" id="logo" name="logo" type="file">
                                @error('logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <input type="hidden" name="header_logo_hidden" value="{{ $sitesetting->logo ?? ''}}">
                                <img id="showImage"  src="{{ (!empty($sitesetting->logo)) ? asset($sitesetting->logo) : url('upload/no_image.jpg') }}" width="214" height='55' >
                            </div>

                             {{--  header Side logo  --}}
                            <div class="form-group mb-3">
                                <label for="logo" class="form-label">Side header logo <span>*</span></label>
                                <input class="form-control  @error('side_header_logo') is-invalid @enderror" id="side_header_logo" name="side_header_logo" type="file" width="214" height='55' >
                                @error('side_header_logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-5">
                                <input type="hidden" name="side_header_logo_hidden" value="{{ $sitesetting->side_header_logo ?? ''}}">
                                <img id="showImageSide"  src="{{ (!empty($sitesetting->side_header_logo)) ? asset($sitesetting->side_header_logo) : url('upload/no_image.jpg') }}" width="214" height='55' >

                            </div>

                             {{-- footer logo  --}}
                             <div class="form-group mb-3">
                                <label for="logo" class="form-label">Footer logo <span>*</span></label>
                                <input class="form-control  @error('footer_logo') is-invalid @enderror" id="footer_logo" name="footer_logo" type="file">
                                @error('footer_logo')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <input type="hidden" name="footer_logo_hidden" value="{{ $sitesetting->footer_logo ?? ''}}">
                                <img id="showImageFooter"  src="{{ (!empty($sitesetting->footer_logo)) ? asset($sitesetting->footer_logo) : url('upload/no_image.jpg') }}" width="118" height='93' >
                            </div>

                            {{-- favicon image  --}}
                            <div class="form-group mb-3">
                                <label class="form-label">Favicon Image</label>
                                <input class="form-control  @error('favicon') is-invalid @enderror" id="favicon" name="favicon" type="file" >
                                @error('favicon')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <input type="hidden" name="hidden_favicon" value="{{ $sitesetting->favicon ?? ''}}">
                                <img id="showImageFavicon"  src="{{ (!empty($sitesetting->favicon)) ? asset($sitesetting->favicon) : url('upload/no_image.jpg') }}" width="50" height='50' >
                            </div>

                            {{--  Social Link  --}}
                            <div class="form-group mb-3">
                                <label for="website" class="form-label">Website </label>
                                <input type="text" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
                                    value="{{ $sitesetting->website ?? '' }}" placeholder="Enter Website URL (e.g., https://www.sprinix.com/example)">
                                @error('website')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="facebook" class="form-label">Facebook </label>
                                <input type="text" name="facebook" id="facebook" class="form-control @error('facebook') is-invalid @enderror"
                                    value="{{ $sitesetting->facebook ?? '' }}" placeholder="Enter Facebook URL (e.g., https://www.facebook.com/example)">
                                @error('facebook')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="twitter" class="form-label">Twitter </label>
                                <input type="text" name="twitter" id="twitter" class="form-control @error('twitter') is-invalid @enderror"
                                    value="{{ $sitesetting->twitter ?? '' }}" placeholder="Enter Twitter URL (e.g., https://twitter.com/example)">
                                @error('twitter')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="instagram" class="form-label">Instagram</label>
                                <input type="text" name="instagram" id="instagram" class="form-control @error('instagram') is-invalid @enderror"
                                    value="{{ $sitesetting->instagram ?? '' }}" placeholder="Enter Instagram URL (e.g., https://www.instagram.com/example)">
                                @error('instagram')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group mb-5">
                                <label for="youtube" class="form-label">Youtube </label>
                                <input type="text" name="youtube" id="youtube" class="form-control @error('youtube') is-invalid @enderror"
                                    value="{{ $sitesetting->youtube ?? '' }}" placeholder="Enter Youtube URL (e.g., https://www.youtube.com/example)">
                                @error('youtube')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary ">Save Changes </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>

{{--  Jquery  --}}
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<script type="text/javascript">
    // Combined Image Upload JS
    $(document).ready(function(){
        function setupImageUpload(inputSelector, previewSelector) {
            $(inputSelector).change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $(previewSelector).attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        }

        // Header logo upload
        setupImageUpload('#logo', '#showImage');

        // Side header logo upload
        setupImageUpload('#side_header_logo', '#showImageSide');

        // Footer logo upload
        setupImageUpload('#footer_logo', '#showImageFooter');

        // Favicon logo upload
        setupImageUpload('#favicon', '#showImageFavicon');
    });

    //Form Validation
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                support_phone: {
                    required: true,
                    number: true,
                    minlength: 10,
                    maxlength: 12,
                },
                company_address: {
                    required: true,
                    maxlength: 255,
                },
                company_name: {
                    required: true,
                    maxlength: 255,
                },
                about: {
                    required: true,
                },

                open_timming: {
                    required: true,
                    maxlength: 255,
                },
                email: {
                    required: true,
                    email: true,
                },
                facebook: {
                    url: true,
                },
                instagram: {
                    url: true,
                },
                youtube: {
                    url: true,
                },
                twitter: {
                    url: true,
                },
                latitude: {
                    required: true,
                },
                longitude: {
                    required: true,
                },
                currency_symbol: {
                    required: true,
                },
            },
            messages: {
                support_phone: {
                    required: 'Please enter a 12-digit phone number.',
                    number: 'Invalid phone number format.',
                    minlength: 'The phone number must be exactly 10 digits.',
                    maxlength: 'The phone number must be exactly 12 digits.',
                },
                company_address: {
                    required: 'Please enter the company address.',
                    maxlength: 'The address may not be greater than 255 characters.',
                },
                company_name: {
                    required: 'Please enter the company name.',
                    maxlength: 'The name may not be greater than 255 characters.',
                },
                open_timming: {
                    required: 'Please enter the opening timing.',
                    maxlength: 'The timing may not be greater than 255 characters.',
                },
                email: {
                    required: 'Please enter a valid email address.',
                    email: 'Invalid email format.',
                },
                facebook: {
                    url: 'Invalid Facebook URL.',
                },
                instagram: {
                    url: 'Invalid Instagram URL.',
                },
                youtube: {
                    url: 'Invalid YouTube URL.',
                },
                twitter: {
                    url: 'Invalid Twitter URL.',
                },
                latitude: {
                    required: 'Please enter the latitude.',
                },
                longitude: {
                    required: 'Please enter the longitude.',
                },
                currency_symbol: {
                    required: 'Please enter the currency symbol',
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                // Disable the submit button to prevent multiple submissions
                $("#submitBtn").prop("disabled", true);

                // Proceed with form submission
                form.submit();
            }
        });
    });
</script>

@endsection
