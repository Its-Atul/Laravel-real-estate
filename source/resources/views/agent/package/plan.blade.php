@extends('agent.agent_dashboard')
@section('title', ' Package Plan')
@section('agent')
<div class="page-content">
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">

        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="{{ route('store.plan') }}">
            @csrf
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid d-flex justify-content-between">
                        <div class="col-lg-3 ps-0">
                            <p class="mt-1 mb-1"><strong>{{ $sitesetting->company_name ?? '' }}</strong></p>
                            <p>{{ $sitesetting->email  ?? ''}},<br> {{ $sitesetting->company_address  ?? ''}}.</p>
                            <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
                            <p>{{ $data->name  ?? ''}},<br> {{ $data->email  ?? ''}},<br> {{ $data->address  ?? ''}}.</p>
                        </div>
                        <div class="col-lg-3 pe-0">
                            <h4 class="fw-bolder text-uppercase text-end mt-4 mb-2">invoice</h4>
                            <h6 class="text-end pb-2">
                                <input type="hidden" name="invoice" value="{{ 'INV' . $invoice ?? ''}}">
                                #{{ 'INV' . $invoice ?? ''}}
                            </h6>
                            <h6 class="text-end pb-2">
                                <input type="hidden" name="data" value="{{ date("Y-m-d H:i:s")}}">
                                {{ date("Y-m-d H:i:s")}}
                            </h6>
                            <p class="text-end mb-1">Balance Due</p>
                            <input type="hidden" name="amount" value="{{ $PackSetting->package_amount  ?? ''}}">
                            <input type="hidden" name="package_name" value="{{ $PackSetting->package_name  ?? ''}}">
                            <input type="hidden" name="package_credits" value="{{ $PackSetting->package_credits  ?? ''}}">
                            <h4 class="text-end fw-normal">{{ $currency_symbol->currency_symbol }}{{ $PackSetting->package_amount  ?? ''}}</h4>
                        </div>
                    </div>
                    <div class="container-fluid mt-5 d-flex justify-content-center w-100">
                        <div class="table-responsive w-100">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Package Name </th>
                                        <th class="text-end">Property Qty</th>
                                        <th class="text-end">Unit cost</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="text-end">
                                        <td class="text-start">1</td>
                                        <td class="text-start">{{ $PackSetting->package_name  ?? ''}}</td>
                                        <td>{{ $PackSetting->package_credits  ?? ''}}</td>
                                        <td>{{ $currency_symbol->currency_symbol }}{{ $PackSetting->package_amount  ?? ''}}</td>
                                        <td>{{ $currency_symbol->currency_symbol }}{{ $PackSetting->package_amount  ?? ''}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="container-fluid w-100">
                        <button type="submit" class="btn btn-primary float-end mb-3 mt-3"><span>{{ $currency_symbol->currency_symbol }}</span> Payment</button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
