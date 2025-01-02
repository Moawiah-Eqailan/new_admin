<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('UsersPage.UserPage.orders', compact('orders'));
    }




    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
    
            // تأكد من البيانات القادمة
            $cartItems = $request->cartItems;
            $total = $request->total;
            $userId = $request->userId;
    
            // إنشاء الطلب
            $order = Order::create([
                'user_id' => $userId,
                'total_amount' => $total,
                'payment_method' => 'cash',
                'status' => 'pending'
            ]);
    
            // حفظ العناصر المرتبطة بالطلب في جدول Order
            foreach ($cartItems as $cartItem) {
                $order->items()->create([ // إذا كنت تستخدم علاقة "many to many"
                    'item_id' => $cartItem['item_id'], 
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['item_price']
                ]);
            }
    
            // مسح السلة بعد حفظ الطلب
            Cart::where('user_id', $userId)->delete();
    
            DB::commit();
    
            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'cartItems' => 'required|array',
        'total' => 'required|numeric',
        'userId' => 'required|exists:users,id',
    ]);

    // إنشاء الطلب
    $order = Order::create([
        'user_id' => $validatedData['userId'],
        'total' => $validatedData['total'],
        'status' => 'Pending', // يمكنك تغيير الحالة حسب الحاجة
    ]);

    // إدراج العناصر المرتبطة بالطلب
    foreach ($validatedData['cartItems'] as $item) {
        $order->items()->create([
            'item_id' => $item['item']['id'],
            'quantity' => $item['quantity'],
            'price' => $item['item']['item_price'],
        ]);
    }

    return response()->json(['success' => true, 'order_id' => $order->id]);
}

}
