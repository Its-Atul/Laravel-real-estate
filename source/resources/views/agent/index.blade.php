@extends('agent.agent_dashboard')
@section('title', 'Agent Dashboard')
@section('agent')
 <div class="page-content">
        <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
          <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Property Message</h6>
                      <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('agent.property.message') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex flex-column">
                        @forelse($propertyMessage as $key => $msg)
                        @php $encryptedId = encrypt($msg->id ?? '') @endphp
                        <a href="{{ route('agent.message.details',$encryptedId) }}" class="d-flex align-items-center border-bottom pb-3">
                            <div class="me-3">
                                <img src="{{ (!empty($msg['user']['photo'])) ? url('upload/user_images/'.$msg['user']['photo']) : url('upload/no_image.jpg') }}" class="rounded-circle wd-35" alt="user">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-body mb-2">{{ $msg['user']['name'] ?? '' }}</h6>
                                    <p class="text-muted tx-12">{{ ($msg->created_at)->format('M d, Y h:i A') }}</p>

                                </div>
                                <p class="text-muted tx-13">{{ (strlen($msg->message ) > 0) ? substr($msg->message , 0, 24). '..' : '' }}</p>
                            </div>
                        </a>
                        @empty
                            <div class=" alert alert-info text-center">No data found</div>
                        @endforelse
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Tour Schedule</h6>
                      <div class="dropdown mb-2">
                        <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <a class="dropdown-item d-flex align-items-center" href="{{ route('agent.schedule.request') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                        </div>
                      </div>
                    </div>
                    <div class="d-flex flex-column">
                        @forelse($schedule as $key => $msg)
                        @php $encryptedId = encrypt($msg->id ?? '') @endphp
                        <a href="{{ route('agent.details.schedule',$encryptedId) }}" class="d-flex align-items-center border-bottom pb-3">
                            <div class="me-3">
                                <img src="{{ (!empty($msg['user']['photo'])) ? url('upload/user_images/'.$msg['user']['photo']) : url('upload/no_image.jpg') }}" class="rounded-circle wd-35" alt="user">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <h6 class="text-body mb-2">{{ $msg['user']['name'] ?? '' }}</h6>
                                    <p class="text-muted tx-12">{{ ($msg->created_at)->format('M d, Y h:i A') }}</p>

                                </div>
                                <p class="text-muted tx-13">{{ (strlen($msg->message ) > 0) ? substr($msg->message , 0, 24). '..' : '' }}</p>
                            </div>
                        </a>
                        @empty
                            <div class=" alert alert-info text-center">No data found</div>
                        @endforelse
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Property</h6>
                  <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                      <a class="dropdown-item d-flex align-items-center" href="{{ route('agent.all.property') }}"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                    </div>
                  </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="pt-0">#</th>
                                <th class="pt-0">Property Name</th>
                                <th class="pt-0">Buy/Rent</th>
                                <th class="pt-0">Status</th>
                                <th class="pt-0">Agent</th>
                                <th class="pt-0">DateTime</th>
                                <th class="pt-0">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($property as $key => $item)
                                <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->property_name ?? ''}}</td>
                                        <td>For {{ $item->property_status ?? ''}}</td>
                                        <td>
                                            @if($item->status == 1)
                                            <span class="badge bg-success">Active</span>
                                            @else
                                            <span class="badge bg-danger">InActive</span>
                                            @endif
                                        </td>
                                        <td>{{ $item['user']['name'] ?? ''}} </td>
                                        <td>{{ ($item->created_at)->format('M d, Y h:i A') }}</td>
                                        <td>
                                            @php $encryptedId = encrypt($item->id ?? '') @endphp
                                            <a href="{{ route('agent.details.property',$encryptedId) }}" class="btn  btn-inverse-info" title="Details"> <i data-feather="eye" style="width: 20px; height:20px;"></i> </a>
                                        </td>
                                </tr>
                            @empty
                                <div class=" alert alert-info text-center">No data found</div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
@endsection
