@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<style>
    .dashboard-header {
        background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
        padding: 2rem;
        border-radius: 15px;
        margin-bottom: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .welcome-text {
        color: white;
        font-size: 1.5rem;
        margin: 0;
    }

    .stat-card {
        transition: transform 0.3s ease;
        border: none;
        border-radius: 15px;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .border-left-primary {
        border-left: 4px solid #4e73df !important;
    }

    .border-left-success {
        border-left: 4px solid #1cc88a !important;
    }

    .border-left-info {
        border-left: 4px solid #36b9cc !important;
    }

    .border-left-warning {
        border-left: 4px solid #f6c23e !important;
    }

    .generate-report-btn {
        background: #4e73df;
        color: #f8f9fa;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .generate-report-btn:hover {
        background: #224abe;
        transform: translateY(-2px);
        color: #f8f9fa;
        text-decoration: none;
    }

    .statistics-table {
        border-radius: 15px;
        overflow: hidden;
    }

    .table thead th {
        background-color: #4e73df;
        color: white;
        font-weight: 600;
        border: none;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
    }

    .progress {
        height: 0.8rem;
        border-radius: 1rem;
    }
</style>

<div class="dashboard-header d-sm-flex align-items-center justify-content-between">
    <h3 class="welcome-text">
        Welcome, {{ Auth::user()->name }} 👋
    </h3>
    <a href="#" id="generateReport" class="generate-report-btn">
        <i class="fas fa-download"></i>
        Download Report
    </a>
</div>

<div id="pageContent">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Sales</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalQuantity }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-primary opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Profits</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format(($totalPrice) , 2 ) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-success opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Products</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalProducts }}%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            style="width: {{ $totalProducts }}%" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-info opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"> {{$totalStatus }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-comments fa-2x text-warning opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xl-12">
            <div class="card shadow-lg stats-card">
                <div class="card-body p-4">
                    <div class="stats-header">
                        <h5 class="stats-title">
                            <i class="fas fa-chart-line me-2"></i>
                            Statistics Overview
                        </h5>
                    </div>
                    <div class="table-responsive statistics-table mt-4">
                        <table class="table custom-table">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Statistic</th>
                                    <th class="text-center">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="stats-row">
                                    <td class="text-center">1</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fas fa-users text-primary me-2" style="margin: 8px;"></i>
                                            Total Users
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="stat-value">
                                            <span class="badge stats-badge success-gradient">
                                                <i class="fas fa-user me-1"></i>
                                                {{ $totalUsers }}
                                            </span>
                                        </div>
                                    </td>

                                </tr>
                                <tr class="stats-row">
                                    <td class="text-center">2</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fas fa-box text-info me-2" style="margin: 8px;"></i>
                                            Total Products
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="stat-value">
                                            <span class="badge stats-badge info-gradient">
                                                <i class="fas fa-cube me-1"></i>
                                                {{ $totalProducts }}
                                            </span>
                                        </div>
                                    </td>

                                </tr>

                                <tr class="stats-row">
                                    <td class="text-center">3</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fas fa-shopping-basket text-secondary me-2" style="margin: 8px;"></i>
                                            Total Sales
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="stat-value">
                                            <span class="badge stats-badge secondary-gradient">
                                                <i class="fas fa-cart-plus me-1"></i>
                                                {{ $totalQuantity }}
                                            </span>
                                        </div>
                                    </td>

                                </tr>
                                <tr class="stats-row">
                                    <td class="text-center">4</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="fas fa-clock text-warning me-2" style="margin: 8px;"></i>
                                            Pending Orders
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="stat-value">
                                            <span class="badge stats-badge warning-gradient">
                                                <i class="fas fa-hourglass-half me-1"></i>
                                                {{$totalStatus }}
                                            </span>
                                        </div>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .stats-card {
            border-radius: 15px;
            border: none;
            background: white;
            transition: all 0.3s ease;
        }

        .stats-header {
            padding-bottom: 1rem;
            border-bottom: 2px solid #f8f9fa;
        }

        .stats-title {
            color: #4e73df;
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
            text-align: center;
        }

        .custom-table {
            margin: 0;
        }

        .custom-table thead tr {
            background: #f8f9fa;
        }

        .custom-table th {
            padding: 1rem;
            font-weight: 600;
            color: #4e73df;
            border: none;
        }

        .stats-row {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f8f9fa;
        }

        .stats-row:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .stats-badge {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            border-radius: 8px;
            border: none;
            color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .success-gradient {
            background: linear-gradient(45deg, #1cc88a, #20daa5);
        }

        .info-gradient {
            background: linear-gradient(45deg, #36b9cc, #3fcfea);
        }

        .warning-gradient {
            background: linear-gradient(45deg, #f6c23e, #ffd454);
        }

        .secondary-gradient {
            background: linear-gradient(45deg, #858796, #9ea1b3);
        }

        .stat-value {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .table td {
            padding: 1rem;
            vertical-align: middle;
        }

        /* Animation for arrows */
        .fas.fa-arrow-up,
        .fas.fa-arrow-down {
            animation: pulse 1.5s infinite;
        }

        @keyframes pulse {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-2px);
            }

            100% {
                transform: translateY(0);
            }
        }
    </style>
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

            pdf.save('dashboard-report.pdf');
        });
    });
</script>
@endsection