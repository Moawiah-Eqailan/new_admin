@include('UsersPage.layouts.header')

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');

        body {
            background: #f5f5f5;
            font-family: 'Tajawal', sans-serif;
        }

        .orders-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .orders-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
            border-radius: 20px;
            padding: 3rem;
            position: relative;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .orders-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('/api/placeholder/1200/400') center/cover;
            opacity: 0.1;
        }

        .orders-title {
            text-align: center;
            color: white;
            margin-top: 1rem;
            font-size: 2rem;
        }

        .orders-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .action-button {
            background: #94CA21;
            color: white;
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .action-button:hover {
            background: #7ab01a;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(148, 202, 33, 0.2);
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
            font-size: 1.5rem;
            color: #94CA21;
        }

        .orders-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 0.5rem;
        }

        .orders-table th {
            padding: 1.2rem;
            text-align: center;
            background: #1a1a1a;
            color: white;
            font-weight: 500;
        }

        .orders-table td {
            padding: 1.2rem;
            text-align: center;
            background: #f8f8f8;
            border: 1px solid #eee;
            transition: all 0.3s ease;
        }

        .orders-table tr:hover td {
            background: #f0f0f0;
            transform: scale(1.01);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-weight: 500;
            text-transform: capitalize;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-delivered {
            background: #d4edda;
            color: #155724;
        }

        .status-cancelled {
            background: #f8d7da;
            color: #721c24;
        }

        .quantity-value {
            background: #94CA21;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 15px;
            font-weight: 500;
        }

        .price-value {
            font-weight: bold;
            color: #94CA21;
        }

        .car-decoration {
            position: absolute;
            bottom: -50px;
            right: -50px;
            font-size: 8rem;
            color: rgba(148, 202, 33, 0.1);
            transform: rotate(-15deg);
        }

        .view-btn {
            color: #94CA21;
            font-size: 1.2rem;
            transition: transform 0.3s;
        }

        .view-btn:hover {
            color: #7ab01a;
            transform: scale(1.1);
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

<div class="orders-container" style="margin-top:80px">
    <div class="orders-header">
        <h1 class="orders-title">Your <span class="text-primary">Orders</span></h1>
     
        <i class="fas fa-box car-decoration"></i>
    </div>

    <div class="info-card">
        <div class="card-header">
            <i class="fas fa-list"></i>
            <h2>Order <span class="text-primary">History</span></h2>
        </div>
        
        <table class="orders-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Total Products</th>
                    <th>Total Price</th>
                    <th>Order Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                <tr class="order-row">
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <span class="quantity-value">
                            {{ number_format($order->orderItems ? $order->orderItems->sum(function ($item) { return $item->quantity; }) : 2) }}
                        </span>
                    </td>
                    <td>
                        <span class="price-value">
                            {{ number_format($order->orderItems ? $order->orderItems->sum(function ($item) { return $item->item->item_price * $item->quantity; }) : 0, 2) }} JOD
                        </span>
                    </td>
                    <td>
                        <span class="status-badge 
                            @if($order->status == 'pending') status-pending
                            @elseif($order->status == 'delivered') status-delivered
                            @elseif($order->status == 'cancelled') status-cancelled
                            @endif">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('DetailOrders', $order->id) }}" class="view-btn" title="View Details">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeachz
            </tbody>
        </table>
    </div>

    <div class="d-flex mt-4">
        <a href="{{ url()->previous() }}" class="btn btn-primary me-2">Back</a>
    </div>
</div>

<footer id="footer" class="bg-dark text-white py-4">
    <div class="container text-center">
        <p>&copy; 2025 BAT<span class="text-primary">PARTS</span></p>
        <div class="d-flex justify-content-center">
            <a href="https://www.facebook.com" class="text-white mx-2">Facebook</a>
            <a href="https://www.x.com" class="text-white mx-2">𝕏</a>
            <a href="https://www.instagram.com" class="text-white mx-2">Instagram</a>
        </div>
    </div>
</footer>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const orderRows = document.querySelectorAll('.order-row');
        
        orderRows.forEach((row, index) => {
            gsap.from(row, {
                duration: 0.5,
                y: 20,
                opacity: 0,
                delay: index * 0.1,
                ease: 'power3.out'
            });
        });

        gsap.from('.orders-title', {
            duration: 1,
            y: 30,
            opacity: 0,
            ease: 'power3.out'
        });

        gsap.from('.car-decoration', {
            duration: 1,
            rotation: -45,
            opacity: 0,
            delay: 0.5,
            ease: 'power3.out'
        });

        gsap.from('.action-button', {
            duration: 0.8,
            y: 20,
            opacity: 0,
            delay: 0.8,
            ease: 'power3.out'
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/jquery-1.11.0.min.js') }}"></script>
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.7/dist/iconify-icon.min.js"></script>