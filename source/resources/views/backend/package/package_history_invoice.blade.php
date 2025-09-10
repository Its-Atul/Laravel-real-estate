<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .page-content {
            padding: 20px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        .card-body {
            flex: 1 1 auto;
            padding: 1.25rem;
        }

        .d-flex {
            display: flex !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }
        .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: none;
            margin-bottom: 20px;
        }
        .container-fluid {
            display: flex;
            justify-content: space-between;
        }

        .col-lg-3 {
            flex: 0 0 25%;
            max-width: 25%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .mt-1 {
            margin-top: 1rem;
        }

        .text-muted {
            color: #6c757d;
        }

        .mt-5 {
            margin-top: 5rem;
        }

        .mb-2 {
            margin-bottom: 2rem;
        }

        .text-end {
            text-align: end;
        }

        .text-start {
            text-align: start;
        }

        .fw-bolder {
            font-weight: bolder;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .w-100 {
            width: 100%;
        }

        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            -ms-overflow-style: -ms-autohiding-scrollbar;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

    </style>
</head>
<body>
<div class="page-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="container-fluid">
                        <div class="col-lg-3 ">
                            <p class="mt-1 mb-1"><strong>{{ $sitesetting->company_name ?? '' }}</strong></p>
                            <p>{{ $sitesetting->email ?? ''}},<br> {{ $sitesetting->company_address ?? ''}}.</p>
                            <h5 class="mt-5 mb-2 text-muted">Invoice to :</h5>
                            <p>{{ $data->name ?? ''}},<br> {{ $data->email ?? ''}},<br> {{ $data->address ?? ''}}.</p>
                        </div>
                        <div class="col-lg-3">
                            <h4 class="fw-bolder text-uppercase text-end" >invoice</h4>
                            <p class="text-end">#{{ $packagehistory->invoice ?? ''}} <br> {{ $packagehistory->created_at ?? ''}}</p>
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
                                        <td class="text-start">{{ $packagehistory->package_name ?? ''}}</td>
                                        <td>{{ $packagehistory->package_credits ?? ''}}</td>
                                        <td>{{ $currency }}{{ $packagehistory->package_amount ?? ''}}</td>
                                        <td>{{ $currency }}{{ $packagehistory->package_amount ?? ''}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
