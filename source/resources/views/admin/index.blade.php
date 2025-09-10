@extends(' admin.admin_dashboard')
@section('title','Admin Dashboard')
@section('admin')

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
                                <h6 class="card-title mb-0">Register User</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item d-flex align-items-center" href="{{route('register.user')}}"><i
                                                data-feather="eye" class="icon-sm me-2"></i> <span
                                                class="">View</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $userCount }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="{{ $growthUserClass }}">
                                            <span>{{ number_format($growthUserPercentage, 1) }}%</span>
                                            <i data-feather="{{ $arrowUserIcon }}" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                   <div id="userChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <h6 class="card-title mb-0">Register Agent</h6>
                                <div class="dropdown mb-2">
                                    <a type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <a class="dropdown-item d-flex align-items-center" href="{{route('register.agent')}}"><i
                                                data-feather="eye" class="icon-sm me-2"></i> <span
                                                class="">View</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 col-md-12 col-xl-5">
                                    <h3 class="mb-2">{{ $agentCount }}</h3>
                                    <div class="d-flex align-items-baseline">
                                        <p class="{{ $growthAgentClass }}">
                                            <span>{{ number_format($growthAgentPercentage, 1) }}%</span>
                                            <i data-feather="{{ $arrowAgentIcon }}" class="icon-sm mb-1"></i>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-6 col-md-12 col-xl-7">
                                    <div id="agentChart" class="mt-md-3 mt-xl-0"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-xl-12 grid-margin stretch-card">
            <div class="card overflow-hidden">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
                        <h6 class="card-title mb-0">Revenue</h6>
                    </div>
                    <div class="row align-items-start">
                        <div class="col-md-7">
                            <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a real estate agency generates from its normal business activities, primarily from the sale of property packages to clients.</p>
                        </div>
                    </div>
                    <div id="monthlyRevenueChart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Monthly sales</h6>
                    </div>
                    <p class="text-muted">Sales are activities related to selling or the number of goods or
                        services sold in a given time period.</p>
                    <div id="monthlySalesChart"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h6 class="card-title mb-0">Tour Schedule</h6>
                        <div class="dropdown mb-2">
                            <a type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.schedule.request') }}"><i
                                        data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        @forelse($schedule as $key => $msg)
                        @php $encryptedId = encrypt($msg->id ?? '')@endphp
                            <a href="{{ route('admin.details.schedule',$encryptedId) }}" class="d-flex align-items-center border-bottom pb-3">
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

    <div class="row">
        <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Property Message</h6>
                        <div class="dropdown mb-2">
                            <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.property.message') }}"><i
                                        data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-column">
                        @forelse($propertyMessage as $key => $msg)
                            @php $encryptedId = encrypt($msg->id ?? '') @endphp
                            <a href="{{ route('admin.message.details',$encryptedId) }}" class="d-flex align-items-center border-bottom pb-3">
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
        <div class="col-lg-7 col-xl-8 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">Latest Property Listed</h6>
                        <div class="dropdown mb-2">
                            <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('all.property') }}"><i
                                        data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
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
                                                <a href="{{ route('details.property',$encryptedId) }}" class="btn  btn-inverse-info" title="Details"> <i data-feather="eye" style="width: 20px; height:20px;"></i> </a>
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
<script>

    var currency_symbol = @json($currency_symbol->currency_symbol);
    // Monthly revenue data
    var monthlyRevenueData = @json($monthlyRevenue->pluck('total_revenue')->toArray() ?? '0');
    var monthYearLabels = @json($monthlyRevenue->pluck('month_year')->toArray() ?? '0');

    // Monthly user registrations data
    var monthlyUserRegistrationsData = @json($monthlyUserRegistrations ?? '0');

    // Monthly agent registrations data
    var monthlyAgentRegistrationsData = @json($monthlyAgentRegistrations ?? '0');

    // Monthly sales data
    var monthlySalesData = @json($monthlySales->pluck('sales_count')->toArray() ?? '0');
    var monthYearLabels = @json($monthlySales->pluck('formatted_date')->toArray() ?? '0');

</script>

@endsection
