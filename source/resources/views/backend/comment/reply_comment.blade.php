@extends('admin.admin_dashboard')
@section('title','Edit/Reply Comment')
@section('admin')
<div class="page-content">
    <div class="row profile-body">
        <!-- middle wrapper start -->
        <div class="col-md-8 col-xl-8 middle-wrapper">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">Reply Comment </h6>
                        <form method="POST" action="{{ route('reply.message') }}" class="forms-sample" id="myForm">
                            @csrf
                            <input type="hidden" name="id" value="{{ $comment->id ?? ''}}">
                            <input type="hidden" name="post_id" value="{{ $comment->post_id ?? '' }}">
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id ?? '' }}">
                            <div class="form-group mb-3">
                                <label class="form-label">User Name : </label>
                                <code> {{ $comment['user']['name'] ?? '' }}</code>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Post Title : </label>
                                <code> {{ $comment['post']['post_title'] ?? '' }}</code>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Subject : </label>
                                <code>{{ $comment->subject ?? '' }}</code>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Message : </label>
                                <code> {{ $comment->message ?? '' }}</code>
                            </div>
                            {{-- <div class="form-group mb-3">
                                <label class="form-label">Subject</label>
                                <textarea name="subject" class="form-control" rows="3"></textarea>
                            </div> --}}
                            @php
                            $commentedit = App\Models\Comment::where('parent_id',$comment->id)->first();
                            @endphp

                            <div class="form-group mb-3">
                                <label class="form-label">Reply Message</label>
                                <textarea name="message" class="form-control"
                                    rows="3">{{ $commentedit->message ?? '' }}</textarea>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary me-2">Reply Comment </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- middle wrapper end -->
    </div>
</div>
<!--jquery-->
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>

<!-- Form Validation-->
<script type="text/javascript">
    $(document).ready(function (){
        $('#myForm').validate({
            rules: {
                message: {
                    required : true,
                },

            },
            messages :{
                message: {
                    required : 'Please enter message',
                },

            },
            errorElement : 'span',
            errorPlacement: function (error,element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
            },
            unhighlight : function(element, errorClass, validClass){
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
