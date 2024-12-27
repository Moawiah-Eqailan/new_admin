<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function home()
    {
        $categories = Category::all();
        $product = Product::all();
        $item = Item::all();
        return view('UsersPage.layouts.app', compact('categories', 'product', 'item'));
    }

    public function findParts(Request $request)
    {
        $parts = Part::where('category_id', $request->category_id)
                     ->where('product_id', $request->product_id)
                     ->where('item_id', $request->item_id)
                     ->get();

        return response()->json($parts);
    }
    
}
