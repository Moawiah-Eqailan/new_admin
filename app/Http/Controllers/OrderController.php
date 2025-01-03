<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;



class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return view('UsersPage.UserPage.orders', compact('orders'));
    }


    public function createOrder(Request $request)
    {
        $user = Auth::user();

        $total = DB::table('items')
            ->join('carts', 'items.id', '=', 'carts.item_id')
            ->where('carts.user_id', $user->id)
            ->sum('items.item_price');

        $cartItems = Cart::where('user_id', $user->id)
            ->with('item')
            ->get();

        try {
            DB::transaction(function () use ($cartItems, $total, $user) {
                $order = Order::create([
                    'user_id' => $user->id,
                    'total' => $total,
                    'status' => 'pending',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($cartItems as $cartItem) {
                    if (!$cartItem->item) {
                        throw new \Exception("Item not found for cart item: " . $cartItem->id);
                    }

                    OrderItem::create([
                        'order_id' => $order->id,
                        'item_id' => $cartItem->item_id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->item->item_price,
                    ]);

                    $cartItem->item->quantity -= $cartItem->quantity;
                    $cartItem->item->save();
                }

                Cart::where('user_id', $user->id)->delete();
            });

            return redirect('cart')
                ->with('swal', [
                    'icon' => 'success',
                    'title' => 'Thank you for shopping with us',
                    'text' => 'Your order is being prepared.',
                ]);
        } catch (\Exception $e) {
            Log::error('Error placing order: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            return redirect('cart')
                ->with('swal', [
                    'icon' => 'error',
                    'title' => 'An error occurred',
                    'text' => 'There was an error while placing your order. Please try again later.',
                ]);
        }
    }
}
