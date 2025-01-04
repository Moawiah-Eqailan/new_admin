<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\ContactUs;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

    public function register()
    {
        return view('auth/register');
    }

    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'postcode' => $request->postcode,
            'city' => $request->city,
            'state' => $request->state,
            'password' => Hash::make($request->password),
            'level' => 'Admin'
        ]);

        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        if (!Auth::attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->role === 'admin') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('home');
    }



    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function profile()
    {
        return view('profile');
    }

    public function index()
    {
        $totalUsers = User::count();
        $totalProducts = Product::count();
        // $totalPurchases = Cart::count();
        $totalCart = Cart::count();
        $totalMessage = ContactUs::count();
        $totalStatus = Order::where('status', 'pending')->count();
        $totalQuantity = OrderItem::sum('quantity');
        $totalPrice = DB::table('order_items')
            ->sum(DB::raw('price * quantity'));

        return view('dashboard', compact('totalUsers', 'totalProducts',  'totalCart', 'totalPrice', 'totalMessage', 'totalQuantity','totalStatus'));
    }


    public function filter(Request $request)
    {
        $categoryId = $request->query('category');
        $productId = $request->query('product');
        $id = $request->query('id');

        $filteredParts = Item::where('category_id', $categoryId)
            ->where('product_id', $productId)
            ->where('id', $id)
            ->get();

        return view('UsersPage.filter', compact('filteredParts'));
    }
}
