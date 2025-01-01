<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('UsersPage.UserPage.orders', compact('orders'));
    }

    public function createOrder(Request $request)
    {
        try {
            $cartItems = Cart::where('user_id', Auth::id())->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Your cart is empty.'], 400);
            }

            Log::info('Cart Items:', $cartItems->toArray());

            $total = $cartItems->sum(function ($item) {
                return $item->item->item_price * $item->quantity;
            });

            if ($total <= 0) {
                return response()->json(['error' => 'Total price calculation failed.'], 400);
            }

            $order = Order::create([
                'user_id' => Auth::id(),
                'order_status' => 'Pending', 
                'category_id',
                'product_id',
                'item_id',
                'cart_id',
                'item_image',
            ]);

            foreach ($cartItems as $cartItem) {
                $order->items()->attach($cartItem->item_id, [
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->item->item_price,
                ]);
            }


            Cart::where('user_id', Auth::id())->delete();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
                'order_id' => $order->id
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating order: ' . $e->getMessage());

            return response()->json(['error' => 'An error occurred while creating the order: ' . $e->getMessage()], 500);
        }
    }
}
