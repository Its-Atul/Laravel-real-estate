@extends('admin.admin_dashboard')
@section('title','All Property')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('property.add'))
            <a href="{{ route('add.property') }}" class="btn btn-inverse-info"> Add Property </a>
            @endif
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Property All </h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Image </th>
                                    <th>Name </th>
                                    <th>Property Type </th>
                                    <th>Status Type </th>
                                    <th>City </th>
                                    <th>Local Area </th>
                                    <th>Code </th>
                                    <th>Status </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($property as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td><img src="{{ asset($item->property_thambnail) }}"style="width:50px; height:50px;"> </td>
                                    <td>{{ $item->property_name ?? ''}}</td>
                                    <td>{{$item['type']['type_name'] ?? ''}}</td>
                                    <td>{{ $item->property_status ?? ''}}</td>
                                    <td>{{ $item['localArea']['city']['name'] ?? ''}}</td>
                                    <td>{{ $item['localArea']['name'] ?? ''}}</td>
                                    <td>{{ $item->property_code ?? ''}}</td>
                                    <td>
                                        @if($item->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">InActive</span>
                                        @endif

                                    </td>
                                    <td>
                                        @if(Auth::user()->can('property.details'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('details.property', $encryptedId) }}" class="btn btn-inverse-info" title="Details">
                                            <i data-feather="eye"></i>
                                        </a>
                                        @endif

                                        @if(Auth::user()->can('property.edit'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('edit.property', $encryptedId) }}" class="btn btn-inverse-warning" title="Edit">
                                            <i data-feather="edit"></i>
                                        </a>
                                        @endif

                                        @if(Auth::user()->can('property.delete'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('delete.property', $encryptedId) }}" class="btn btn-inverse-danger" id="delete" title="Delete">
                                            <i data-feather="trash-2"></i>
                                        </a>
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
