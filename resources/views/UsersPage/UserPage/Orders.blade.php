@include('UsersPage.layouts.header')

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap');
        
        body {
            background: #f5f5f5;
            font-family: 'Tajawal', sans-serif;
        }

        .orders-header {
            background: #1a1a1a;
            padding: 2rem;
            border-radius: 15px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .orders-title {
            color: white;
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-family:'Kalam', cursive;
        }

        .order-table {
            width: 100%;
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }

        th, td {
            padding: 1rem;
            text-align: center;
            border: 1px solid #ddd;
            font-size: 1rem;
        }

        th {
            background-color: #94CA21;
            color: white;
        }

        td {
            background-color: #f9f9f9;
        }

        .action-button {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            background: #94CA21;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .action-button:hover {
            background: #7ab01a;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(148, 202, 33, 0.2);
        }

    </style>
</head>

<div class="container"style="margin-top:80px">
    <div class="orders-header">
        <h1 class="orders-title">

            <i class="fas fa-box"></i> عرض الأوامر
        </h1>
    </div>

    <div class="order-table">
        <table>
            <thead>
                <tr>
                    <th>رقم الطلب</th>
                    <th>المنتج</th>
                    <th>الفئة</th>
                    <th>حالة الطلب</th>
                    <th> صوره المنتج</th>
                    <th>الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->product_id }}</td>
                        <td>{{ $order->category_id }}</td>
                        <td>
                            <span class="badge 
                                @if($order->order_status == 'pending') 
                                    bg-warning 
                                @elseif($order->order_status == 'delivered') 
                                    bg-success 
                                @elseif($order->order_status == 'cancelled') 
                                    bg-danger 
                                @endif">
                                {{ $order->order_status }}
                            </span>
                        </td>
                        <td><img src="https://2.bp.blogspot.com/-_xt1l3SQjf4/ViDuvIfFU2I/AAAAAAAA5Xc/S1yMyotgar4/s1600/beautiful-twilight-wallpaper-free-download-1024x640.jpg" class="card-img-top" style="width: 100%; height: 200px; object-fit: contain;"></td>
                        </td>

                        <td>
                                <i class="fas fa-edit"></i> تعديل
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('UsersPage.layouts.footer')
