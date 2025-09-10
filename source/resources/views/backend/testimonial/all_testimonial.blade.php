@extends('admin.admin_dashboard')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('testimonials.add'))
            <a href="{{ route('add.testimonials') }}" class="btn btn-inverse-info"> Add Testimonials </a>
            @endif
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Testimonials All </h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th> Sl </th>
                                    <th> Name </th>
                                    <th> Position </th>
                                    <th> Image </th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($testimonial as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->position }}</td>
                                    <td><img src="{{ asset($item->image) }}" class="wd-50 rounded-circle"> </td>
                                    <td>
                                        @if(Auth::user()->can('testimonials.edit'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('edit.testimonials',$encryptedId) }}"  class="btn btn-inverse-warning"> Edit </a>
                                        @endif
                                        @if(Auth::user()->can('testimonials.delete'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('delete.testimonials',$encryptedId) }}"   class="btn btn-inverse-danger" id="delete"> Delete </a>
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
