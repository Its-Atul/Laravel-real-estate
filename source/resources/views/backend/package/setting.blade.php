@extends('admin.admin_dashboard')
@section('title','Package Setting')
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
                    <h6 class="card-title">Package Setting </h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Package Name </th>
                                    <th>Package Credits </th>
                                    <th>Package Amount </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($package as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item['package_name'] }}</td>
                                    <td>{{ $item->package_credits }}</td>
                                    <td>{{ $item->package_amount }}</td>
                                    <td>
                                        @if(Auth::user()->can('edit.package'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('package.edit',$encryptedId) }}"
                                            class="btn btn-inverse-warning"> Edit </a>
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
