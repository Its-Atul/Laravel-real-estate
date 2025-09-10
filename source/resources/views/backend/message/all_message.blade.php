@extends('admin.admin_dashboard')
@section('title','All Message')
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
                    <h6 class="card-title">All Message</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Image </th>
                                    <th>Name </th>
                                    <th>Email </th>
                                    <th>Property </th>
                                    <th>Property Status </th>
                                    <th> Status </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usermsg as $key => $msg)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <img class="wd-50 ht-50 rounded-circle" src="{{ (!empty($msg['user']['photo'])) ? url('upload/user_images/'.$msg['user']['photo']) : url('upload/no_image.jpg') }}" alt="image" >
                                    </td>
                                    <td>{{ $msg['user']['name'] ?? '' }}</td>
                                    <td>{{ $msg['user']['email'] ?? '' }}</td>
                                    <td>{{ $msg['property']['property_name'] ?? '....' }}</td>
                                    <td>{{ ucfirst($msg['property']['property_status'] ?? '....') }}</td>
                                    <td>
                                        <span class="badge {{ $msg['admin_status'] == 'read' ? 'bg-primary' : 'bg-secondary' }}">
                                            {{ ucfirst($msg['admin_status'] ?? '') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(Auth::user()->can('message.details'))
                                        @php $encryptedId = encrypt($msg->id ?? '');@endphp
                                        <a href="{{ route('admin.message.details',$encryptedId ) }}"
                                            class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i>
                                        </a>
                                        @endif
                                        @if(Auth::user()->can('message.delete'))
                                        @php $encryptedId = encrypt($msg->id ?? '');@endphp
                                        <a href="{{ route('admin.message.delete',$encryptedId) }}" class="btn btn-inverse-danger" id="delete"> Delete </a>
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
@endsection
