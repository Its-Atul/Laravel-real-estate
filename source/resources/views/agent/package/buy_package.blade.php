@extends('agent.agent_dashboard')
@section('title', 'Choose a plan')
@section('agent')

<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">

        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center mb-3 mt-4">Choose a plan </h3>
                    @if($CurrentPlan)
                    <h6 class="text-center mb-3 mt-4">Current plan: <span class="text-danger">{{ $CurrentPlan ?? '' }}</span></h6>
                    @endif
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-center mt-3 mb-4">{{ $PackBasic->package_name}}</h4>
                                        <i data-feather="award" class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                        <h1 class="text-center">{{ $currency_symbol->currency_symbol }}{{ $PackBasic->package_amount}}</h1>
                                        <p class="text-muted text-center mb-4 fw-light">Limited</p>
                                        <h5 class="text-primary text-center mb-4">Up to {{ $PackBasic->package_credits}} Property </h5>
                                        <table class="mx-auto">
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                                <td>
                                                    <p>Up to {{ $PackBasic->package_credits}} Property</p>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td><i data-feather="x" class="icon-md text-danger me-2"></i></td>
                                                <td>
                                                    <p class="text-muted">Premium Support</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="d-grid">
                                            <a href="{{ route('buy.basic.plan') }}"
                                                class="btn btn-primary mt-4">Start Now </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 stretch-card grid-margin grid-margin-md-0">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-center mt-3 mb-4">{{ $PackBusiness->package_name }}</h4>
                                        <i data-feather="gift" class="text-success icon-xxl d-block mx-auto my-3"></i>
                                        <h1 class="text-center">{{ $currency_symbol->currency_symbol }}{{ $PackBusiness->package_amount }}</h1>
                                        <p class="text-muted text-center mb-4 fw-light">Unlimited Months</p>
                                        <h5 class="text-success text-center mb-4">Up to {{ $PackBusiness->package_credits }} Property </h5>
                                        <table class="mx-auto">
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                                <td>
                                                    <p>Up to {{ $PackBusiness->package_credits }} Property</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                                <td>
                                                    <p>Premium Support</p>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="d-grid">
                                            <a href="{{ route('buy.business.plan') }}"
                                                class="btn btn-success mt-4">Start Now </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="text-center mt-3 mb-4">{{ $PackProfessional->package_name }}</h4>
                                        <i data-feather="briefcase"
                                            class="text-primary icon-xxl d-block mx-auto my-3"></i>
                                        <h1 class="text-center">{{ $currency_symbol->currency_symbol }}{{ $PackProfessional->package_amount }}</h1>
                                        <p class="text-muted text-center mb-4 fw-light">Unlimited Months</p>
                                        <h5 class="text-primary text-center mb-4">Up to {{ $PackProfessional->package_credits }} Property</h5>
                                        <table class="mx-auto">
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                                <td>
                                                    <p>Up to {{ $PackProfessional->package_credits }} Property</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><i data-feather="check" class="icon-md text-primary me-2"></i></td>
                                                <td>
                                                    <p>Premium Support </p>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="d-grid">
                                            <a href="{{ route('buy.professional.plan') }}"
                                                class="btn btn-primary mt-4">Start Now </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
