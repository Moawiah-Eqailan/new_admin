@include('UsersPage.layouts.header')

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');

        body {
            background: #f5f5f5;
            margin: 0;
            font-family: 'Tajawal', sans-serif;
        }

        .profile-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .profile-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
            border-radius: 20px;
            padding: 3rem;
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
            color: white;
        }

        .order-title {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 1rem;
        }

        .order-status {
            text-align: center;
            padding: 0.5rem 1.5rem;
            border-radius: 30px;
            display: inline-block;
            font-weight: bold;
            margin: 1rem auto;
            background: #94CA21;
        }

        .status-pending {
            background: #FEF3C7;
            color: #D97706;
        }

        .status-delivered {
            background: #D1FAE5;
            color: #059669;
        }

        .status-cancelled {
            background: #FEE2E2;
            color: #DC2626;
        }

        .info-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            color: #1a1a1a;
        }

        .card-header i {
            color: #94CA21;
            font-size: 1.5rem;
        }

        .order-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .summary-item {
            text-align: center;
            padding: 1rem;
            background: #f8f8f8;
            border-radius: 10px;
        }

        .summary-label {
            color: #666;
            margin-bottom: 0.5rem;
        }

        .summary-value {
            font-size: 1.2rem;
            font-weight: bold;
            color: #94CA21;
        }

        .items-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
        }

        .item-card {
            background: #f8f8f8;
            border-radius: 15px;
            padding: 1.5rem;
            display: flex;
            gap: 1rem;
            transition: transform 0.3s;
        }

        .item-card:hover {
            transform: translateY(-5px);
        }

        .item-image {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            object-fit: cover;
        }

        .item-details {
            flex: 1;
        }

        .item-name {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .item-price {
            color: #94CA21;
            font-weight: bold;
        }

        .car-decoration {
            position: absolute;
            bottom: -50px;
            right: -50px;
            font-size: 8rem;
            color: rgba(148, 202, 33, 0.1);
            transform: rotate(-15deg);
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated {
            animation: slideIn 0.5s ease forwards;
        }
    </style>
</head>


<div class="profile-container" style="margin-top:80px">
    <div class="profile-header">
        <h1 class="order-title" style="color: #fff;">Detail <span class="text-primary">Order</span>
        </h1>


        <div class="order-status 
                @if($order->status == 'pending') status-pending
                @elseif($order->status == 'delivered') status-delivered
                @elseif($order->status == 'cancelled') status-cancelled
                @endif">
                {{ $order->status }}
        </div>
        <i class="fas fa-car car-decoration"></i>
    </div>

    <div class="info-card">
    <div class="card-header">
        <i class="fas fa-info-circle"></i>
        <h2>Order Summary</h2>
    </div>
    <div class="order-summary" style="display: flex; justify-content: space-between; align-items: center;">
        <div class="summary-item" style="flex: 1; text-align: left;">
            <div class="summary-label">Total Items</div>
            <div class="summary-value">{{ $order->orderItems->sum('quantity') }}</div>
        </div>
        <div class="summary-item" style="flex: 1; text-align: left;">
            <div class="summary-label">Total Amount</div>
            <div class="summary-value">{{ number_format($order->orderItems ? $order->orderItems->sum(function ($item) { return $item->item->item_price * $item->quantity; }) : 0, 2) }} JOD</div>
        </div>
    </div>
</div>


    <div class="info-card">
        <div class="card-header">
            <i class="fas fa-shopping-bag"></i>
            <h2>Order Items</h2>
        </div>
        <div class="items-grid">
            @foreach ($order->orderItems as $item)
            <div class="item-card">
                <img src="{{ asset('storage/' . $item->item->item_image) }}"
                    alt="{{ $item->item->item_name }}"
                    class="item-image"
                    style="object-fit: contain;">
                <div class="item-details">
                    <div class="item-name">{{ $item->item->item_name }}</div>
                    <div class="item-quantity">Quantity: {{ $item->quantity }}</div>
                    <div class="item-price">{{ number_format($item->item->item_price * $item->quantity, 2) }} JOD</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const elements = document.querySelectorAll('.summary-item, .item-card');
        elements.forEach((element, index) => {
            setTimeout(() => {
                element.classList.add('animated');
            }, index * 100);
        });
    });
</script>