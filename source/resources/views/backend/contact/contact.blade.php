@extends('admin.admin_dashboard')
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
                    <h6 class="card-title">All Contact</h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Name </th>
                                    <th>Email </th>
                                    <th>Subject </th>
                                    <th>Status </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($contact as $key => $msg)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $msg['username'] ?? '' }}</td>
                                    <td>{{ $msg['email'] ?? '' }}</td>
                                    <td class="text-wrap">{{ $msg['subject'] ?? '' }}</td>
                                    <td>
                                        <span class="badge {{ $msg['status'] == 'read' ? 'bg-primary' : 'bg-secondary' }}">
                                            {{ ucfirst($msg['status'] ?? '') }}
                                        </span>
                                    </td>
                                    <td>
                                        @if(Auth::user()->can('contact.details'))
                                        @php $encryptedId = encrypt($msg->id ?? ''); @endphp
                                        <a href="{{ route('admin.contact.details',$encryptedId) }}"
                                            class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i>
                                        </a>
                                        @endif
                                        @if(Auth::user()->can('contact.delete'))
                                        @php $encryptedId = encrypt($msg->id ?? ''); @endphp
                                        <a href="{{ route('admin.contact.delete',$encryptedId) }}" class="btn btn-inverse-danger" id="delete"> Delete </a>
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
