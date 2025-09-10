@extends('admin.admin_dashboard')
@section('title','All Roles')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('role.add'))
            <a href="{{ route('add.roles') }}" class="btn btn-inverse-info"> Add Roles </a>
            @endif
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">All Roles </h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Roles Name </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        @if(Auth::user()->can('role.edit'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('edit.roles',$encryptedId) }}" class="btn btn-inverse-warning">
                                            Edit </a>
                                        @endif
                                        @if(Auth::user()->can('role.delete'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('delete.roles',$encryptedId) }}" class="btn btn-inverse-danger"
                                            id="delete"> Delete </a>
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
