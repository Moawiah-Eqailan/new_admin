@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')


<!-- Page Heading -->

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
</head>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="mb-0" style="font-size: 25px;">
        <div>Welcome {{ Auth::user()->name }}</div>
    </h1>
    <a href="#" id="generateReport" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
    </a>
</div>

<div id="pageContent">
    <!-- Content Row -->
    <div class="row">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Cart Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCart }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Price Total</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $totalPrice }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Products</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalProducts }}% </div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: {{ $totalProducts }}%" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Order</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$totalMessage}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Table -->
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow h-100 py-4">
                <div class="card-body">
                    <h5 class="text-center text-primary fw-bold">Statistics Overview</h5>
                    <table class="table table-hover table-striped table-bordered align-middle mt-3">
                        <thead class="table-primary">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Statistic</th>
                                <th scope="col" class="text-center">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row" class="text-center">1</th>
                                <td>Total Users</td>
                                <td class="text-center"><span class="badge bg-success fs-6" style="color: white;">{{ $totalUsers }}</span></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">2</th>
                                <td>Total Products</td>
                                <td class="text-center"><span class="badge bg-info fs-6" style="color: white;">{{ $totalProducts }}</span></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">3</th>
                                <td>Total Purchases</td>
                                <td class="text-center"><span class="badge bg-warning fs-6" style="color: white;">{{ $totalPurchases }}</span></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">3</th>
                                <td>Total Cart </td>
                                <td class="text-center"><span class="badge bg-secondary fs-6" style="color: white;">{{ $totalPurchases }}</span></td>
                            </tr>
                            <tr>
                                <th scope="row" class="text-center">4</th>
                                <td>Pending Order</td>
                                <td class="text-center"><span class="badge bg-warning fs-6" style="color: white;">15</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.getElementById('generateReport').addEventListener('click', function() {
            const element = document.getElementById('pageContent');

            html2canvas(element).then((canvas) => {
                const pdf = new jspdf.jsPDF('p', 'mm', 'a4');
                const imgData = canvas.toDataURL('image/png');

                const pageWidth = pdf.internal.pageSize.getWidth();
                const pageHeight = pdf.internal.pageSize.getHeight();
                const imgWidth = pageWidth;
                const imgHeight = (canvas.height * pageWidth) / canvas.width;

                let position = 0;
                pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);

                pdf.save('report.pdf');
            });
        });
    </script>

    @endsection