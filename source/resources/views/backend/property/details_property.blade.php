@extends('admin.admin_dashboard')
@section('title','Property Details')
@section('admin')
<div class="page-content">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Property Details </h6>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td>Property Name </td>
                                    <td><code class="text-wrap">{{ $property->property_name ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Status </td>
                                    <td><code>{{ $property->property_status ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Lowest Price </td>
                                    <td><code>{{ $property->lowest_price ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Max Price </td>
                                    <td><code>{{ $property->max_price ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>BedRooms </td>
                                    <td><code>{{ $property->bedrooms ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Bathrooms </td>
                                    <td><code>{{ $property->bathrooms ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Garage </td>
                                    <td><code>{{ $property->garage ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Garage Size </td>
                                    <td><code>{{ $property->garage_size ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Address </td>
                                    <td><code class="text-wrap">{{ $property->address ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Local Area </td>
                                    <td><code>{{ $property['localArea']['name'] ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>City </td>
                                    <td><code>{{ $property['localArea']['city']['name'] ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>State </td>
                                    <td><code>{{ $property['localArea']['city']['state']['state_name'] ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Country </td>
                                    <td><code>{{ $property['localArea']['city']['state']['Country']['name'] ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Postal Code </td>
                                    <td><code>{{ $property->postal_code ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Main Image </td>
                                    <td>
                                        <img src="{{ asset($property->property_thambnail) }}"style="width:50px; height:50px;">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Status </td>
                                    <td>
                                        @if($property->status == 1)
                                        <span class="badge rounded-pill bg-success">Active</span>
                                        @else
                                        <span class="badge rounded-pill bg-danger">InActive</span>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped mb-5">
                            <tbody>
                                <tr>
                                    <td>Property Code </td>
                                    <td><code>{{ $property->property_code ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Size </td>
                                    <td><code>{{ $property->property_size ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Video</td>
                                    <td><code class="text-wrap">{{ $property->property_video ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Neighborhood </td>
                                    <td><code>{{ $property->neighborhood ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Latitude </td>
                                    <td><code>{{ $property->latitude ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Longitude </td>
                                    <td><code>{{ $property->longitude ?? ''}}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Type </td>
                                    <td><code>{{ $property['type']['type_name'] ?? '' }}</code></td>
                                </tr>
                                <tr>
                                    <td>Property Amenities </td>
                                    <td>
                                        <code>
                                            @foreach($amenities as $amenity)
                                                {{ $amenity->amenitis_name ?? '' }}</br>
                                            @endforeach
                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Short Description </td>
                                    <td>
                                        <code class="text-wrap">
                                           {{ $property->short_descp ?? ''}}
                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Long Description </td>
                                    <td>
                                        <code class="text-wrap">
                                            {!! $property->long_descp ?? '' !!}
                                        </code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Agent </td>
                                    <td><code> {{ $property['user']['name'] ?? ''}} </code></td>
                                </tr>
                            </tbody>
                        </table>
                        @if($property->status == 1)
                            <form method="post" action="{{ route('inactive.property') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $property->id ?? ''}}">
                                <button type="submit" class="btn btn-primary">InActive </button>
                            </form>
                        @else
                            <form method="post" action="{{ route('active.property') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $property->id ?? ''}}">

                                <button type="submit" class="btn btn-primary">Active </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
