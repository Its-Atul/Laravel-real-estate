@extends('agent.agent_dashboard')
@section('title', 'All Schedule Request')
@section('agent')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title"> All Schedule Request </h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Image</th>
                                    <th>Name </th>
                                    <th>Email </th>
                                    <th>Property </th>
                                    <th>Date </th>
                                    <th>Time </th>
                                    <th>Status </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usermsg as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>
                                        <img class="wd-50 rounded-circle" src="{{ (!empty($item['user']['photo'])) ? url('upload/user_images/'.$item['user']['photo']) : url('upload/no_image.jpg') }}" alt="image" >
                                    </td>
                                    <td>{{ $item['user']['name'] ?? ''}}</td>
                                    <td>{{ $item['user']['email'] ?? ''}}</td>
                                    <td>{{ $item['property']['property_name'] ?? ''}}</td>
                                    <td>{{ date('d F Y', strtotime($item->tour_date ?? '')) }}</td>
                                    <td>{{ $item->tour_time ?? '' }}</td>
                                    <td>
                                        @if($item->status == 1)
                                        <span class="badge rounded-pill bg-success">Confirm</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">Pending</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('agent.details.schedule',$encryptedId) }}"
                                            class="btn btn-inverse-info" title="Details"> <i data-feather="eye"></i>
                                        </a>
                                        <a href="{{ route('agent.delete.schedule',$encryptedId) }}"
                                            class="btn btn-inverse-danger" id="delete" title="Delete"> <i
                                                data-feather="trash-2"></i> </a>
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
