<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    // public function addToCart(Request $request, $itemId) {
    //     try {
    //         // Add item to cart logic
    //         return response()->json(['success' => true, 'message' => 'Item added to cart']);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false, 'message' => 'Failed to add item to cart']);
    //     }
    // }
    
    public function addToCart($item_id)
    {
        $user = auth()->user();

        // إذا لم يكن المستخدم مسجلاً للدخول
        if (!$user) {
            $cart = Session::get('cart', []);

            if (isset($cart[$item_id])) {
                // إذا كان العنصر موجودًا في السلة، قم بإزالته
                unset($cart[$item_id]);
            } else {
                // إذا لم يكن العنصر موجودًا، قم بإضافته
                $cart[$item_id] = 1; // الكمية تبدأ من 1
            }

            Session::put('cart', $cart);

            return response()->json([
                'success' => true,
                'isInCart' => isset($cart[$item_id]), // تحقق إذا كان العنصر في السلة
            ]);
        }

        // إذا كان المستخدم مسجلاً، استخدم جدول السلة المرتبط
        $cartItem = Cart::where('item_id', $item_id)->where('user_id', $user->id)->first();

        if ($cartItem) {
            // إذا كان العنصر موجودًا في السلة، قم بإزالته
            $cartItem->delete();
        } else {
            // إذا لم يكن العنصر موجودًا في السلة، قم بإضافته
            Cart::create([
                'user_id' => $user->id,
                'item_id' => $item_id,
                'quantity' => 1, // الكمية تبدأ من 1
            ]);
        }

        return response()->json([
            'success' => true,
            'isInCart' => $cartItem ? false : true, // تحقق إذا كان العنصر في السلة
        ]);
    }

    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            // إذا لم يكن المستخدم مسجلاً، احصل على العناصر في السلة من الجلسة
            $cart = session()->get('cart', []);
            $cartItems = Item::whereIn('id', array_keys($cart))->get();
            foreach ($cartItems as $item) {
                $item->quantity = $cart[$item->id];
            }
        } else {
            // إذا كان المستخدم مسجلاً، احصل على العناصر من جدول السلة
            $cartItems = $user->cartItems;
        }

        return view('Cart', compact('cartItems'));
    }
}
