@extends('admin.admin_dashboard')
@section('title','All Blog Comment')
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
                    <h6 class="card-title">Blog Comment All </h6>
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>Sl </th>
                                    <th>Post Title </th>
                                    <th>User Name </th>
                                    <th>Subject </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comment as $key => $item)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $item['post']['post_title'] }}</td>
                                    <td>{{ $item['user']['name'] }}</td>
                                    <td>{{ $item->subject }}</td>
                                    <td>
                                        @if(Auth::user()->can('blog.comment.reply'))
                                        @php $encryptedId = encrypt($item->id); @endphp
                                        <a href="{{ route('admin.comment.reply',$encryptedId) }}"
                                            class="btn btn-inverse-warning">
                                            {{ $item->status != 'reply' ? 'Reply' : 'Edit' }}
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
