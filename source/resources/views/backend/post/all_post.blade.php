@extends('admin.admin_dashboard')
@section('title','All Posts')
@section('admin')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            @if(Auth::user()->can('blog.post.add'))
            <a href="{{ route('add.post') }}" class="btn btn-inverse-info"> Add Post </a>
            @endif
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Post All </h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl</th>
                                    <th>Post Title </th>
                                    <th>Category</th>
                                    <th>Post Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($post as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item->post_title }}</td>
                                    <td>{{ $item['cat']['category_name'] }}</td>
                                    <td><img src="{{ asset($item->post_image) }}" style="width:50px;height: 50px;">
                                    </td>
                                    <td>
                                        @if(Auth::user()->can('blog.post.edit'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('edit.post',$encryptedId) }}" class="btn btn-inverse-warning">Edit </a>
                                        @endif

                                        @if(Auth::user()->can('blog.post.delete'))
                                        @php $encryptedId = encrypt($item->id ?? ''); @endphp
                                        <a href="{{ route('delete.post',$encryptedId) }}" class="btn btn-inverse-danger" id="delete"> Delete </a>
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
