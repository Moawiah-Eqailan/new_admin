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
        return view('layout.app', compact('categories', 'product', 'item'));
    }

    public function findParts(Request $request)
    {
        // جلب الأجزاء بناءً على الفئة، المنتج والعنصر
        $parts = Part::where('category_id', $request->category_id)
                     ->where('product_id', $request->product_id)
                     ->where('item_id', $request->item_id)
                     ->get();

        // إرجاع البيانات بتنسيق JSON
        return response()->json($parts);
    }
}
