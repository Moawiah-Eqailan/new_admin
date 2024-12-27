<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request, $item_id)
    {
        $item = Item::findOrFail($item_id);

        if (auth()->check()) {
            $cartItem = Cart::where('item_id', $item_id)->where('user_id', auth()->id())->first();

            if ($cartItem) {
                $cartItem->quantity += 1;
                $cartItem->save();
            } else {
                Cart::create([
                    'user_id' => auth()->id(),
                    'item_id' => $item_id,
                    'quantity' => 1,
                    'created_at' => Carbon::now(),
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$item_id])) {
                $cart[$item_id]['quantity']++;
            } else {
                $cart[$item_id] = [
                    'item_id' => $item_id,
                    'quantity' => 1,
                ];
            }

            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item added to the cart.',
        ]);
    }

    public function updateCart(Request $request, $cartId)
    {
        if (auth()->check()) {
            $cartItem = Cart::findOrFail($cartId);
            $cartItem->quantity = $request->quantity;
            $cartItem->save();

            $total = Cart::with('item')->where('user_id', auth()->id())->get()->sum(function ($item) {
                return $item->item->item_price * $item->quantity;
            });

            return response()->json(['success' => true, 'total' => $total]);
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$cartId])) {
                $cart[$cartId]['quantity'] = $request->quantity;
                session()->put('cart', $cart);

                $total = array_reduce($cart, function ($carry, $item) {
                    return $carry + ($item['price'] * $item['quantity']);
                }, 0);

                return response()->json(['success' => true, 'total' => $total]);
            }
        }

        return response()->json(['success' => false, 'message' => 'Item not found']);
    }


    public function removeFromCart($cartId)
    {
        if (auth()->check()) {
            $cartItem = Cart::findOrFail($cartId);
            $cartItem->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$cartId]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.view');
    }

    public function viewCart()
    {
        if (auth()->check()) {
            $cartItems = Cart::where('user_id', auth()->id())->get();
        } else {
            $cartItems = session()->get('cart', []);
        }

        return view('UsersPage.Cart', compact('cartItems'));
    }

    public function statistics()
    {
        $totalCart = Cart::count();
        return view('dashboard', compact('totalCart'));
    }
}
