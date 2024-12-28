<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::orderBy('created_at', 'DESC')->get();

        return view('Admin.products.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $categories = Category::pluck('category_name', 'category_id');

        return view('Admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|integer',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products/images', 'public');
            $validatedData['product_image'] = $imagePath;
        }

        Product::create($validatedData);

        return redirect()->route('products')->with('success', 'Product added successfully.');
    }





    /**
     * Display the specified resource.
     */
    public function show(string $product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::pluck('category_name', 'category_id');

        return view('Admin.products.show', compact('product','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */


    public function edit(string $product_id)
    {
        $product = Product::findOrFail($product_id);

        $categories = Category::pluck('category_name', 'category_id');

        return view('Admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $product_id)
    {
        $product = Product::findOrFail($product_id);

        if ($request->hasFile('image')) {
            if ($product->product_image && Storage::exists('public/' . $product->product_image)) {
                Storage::delete('public/' . $product->product_image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
        } else {
            $imagePath = $product->product_image;
        }

        $product->update([
            'product_name' => $request->title,
            'category_id' => $request->category_id,
            'product_image' => $imagePath,
        ]);

        return redirect()->route('products')->with('success', 'Product updated successfully');
    }



    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $product_id)
    // {
    //     $product = Product::findOrFail($product_id);

    //     $product->delete();

    //     return redirect()->route('products')->with('success', 'Product deleted successfully');
    // }


    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->items()->delete();

        $product->delete();

        return redirect()->route('products')->with('success', 'Product deleted successfully');
    }




    public function search(Request $request)
    {
        $query = $request->input('query');

        $product = Product::where('product_id', $query)
            ->orWhere('product_name', 'LIKE', "%$query%")
            ->orWhere('category_id', 'LIKE', "%$query%")
            ->get();

        return view('Admin.products.index', ['product' => $product]);
    }


    public function app()
    {
        $product = Product::all();
        return view('UsersPage.layouts.app', compact('product'));
    }
    


    public function view()
    {
        $product = Product::all();
        return view('UsersPage.product', compact('product'));
    }

    public function showProducts($category_id)
    {
        $product = Product::where('category_id', $category_id)->with('category')->get();
        $categories = Category::pluck('category_name', 'category_id');

        return view('UsersPage.product', compact('product', 'categories'));
    }

    public function getProductsByCategory($categoryId)
    {
        $products = Product::where('category_id', $categoryId)->get();
        return response()->json($products);
    }


    public function statistics()
    {
        $totalProducts = Product::count();
        $totalPurchases = Cart::count(); // Replace 'Order' with your actual purchases model
        return view('dashboard', compact('totalProducts', 'totalPurchases'));
    }
}
