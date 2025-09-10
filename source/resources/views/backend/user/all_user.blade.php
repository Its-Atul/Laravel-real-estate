@extends('admin.admin_dashboard')
@section('title','All Register Users')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">

        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Register User</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Image </th>
                                    <th>Name </th>
                                    <th>Email </th>
                                    <th>Change </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alluser as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><img src="{{ (!empty($item->photo)) ? url('upload/user_images/'.$item->photo) : url('upload/no_image.jpg') }}"
                                            style="width:50px; height:50px;"> </td>
                                    <td>{{ $item->name ?? ''}}</td>
                                    <td>
                                        {{$item->email}}
                                    </td>

                                    <td>
                                        @if(Auth::user()->can('user.status.change'))
                                        <input data-id="{{ $item->id }}" class="toggle-class" type="checkbox"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-on="Active" data-off="Inactive" {{ $item->status == 'active' ? 'checked' : '' }} >
                                        @endif
                                    </td>
                                    <td>
                                        @if(Auth::user()->can('user.details'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('user.details',$encryptedId) }}" class="btn btn-inverse-warning"
                                            title="User Details"> <i data-feather="eye"></i> </a>
                                        @endif
                                        @if(Auth::user()->can('user.delete'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('delete.user',$encryptedId) }}" class="btn btn-inverse-danger"
                                            id="delete" title="Delete"> <i data-feather="trash-2"></i> </a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- JQuery --}}
<script src="{{ asset('backend/assets/js/jquery.min.js') }}"></script>
{{-- toogle js --}}
<script type="text/javascript">
    $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var user_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/changeUserStatus',
                    data: {'status': status, 'user_id': user_id},
                    success: function(data){
                    // console.log(data.success)

                        // Start Message

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {

                            Toast.fire({
                            type: 'success',
                            title: data.success,
                            })

                    }else{

                Toast.fire({
                            type: 'error',
                            title: data.error,
                            })
                        }

                    // End Message


                    }
                });
            })
        })
</script>
@endsection
