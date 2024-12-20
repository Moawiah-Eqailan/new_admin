<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Category;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the items.
     */
    public function index()
    {
        $items = Item::orderBy('created_at', 'DESC')->paginate(10);

        return view('Items.index', compact('items'));
    }

    /**
     * Show the form for creating a new item.
     */
    public function create()
    {
        $product = Product::pluck('product_name', 'product_id');

        return view('Items.create', compact('product'));
    }

    /**
     * Store a newly created item in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'item_description' => 'required|string',
            'item_price' => 'required|numeric',
            'item_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_id' => 'required|integer', 
        ]);

        $product = Product::findOrFail($validatedData['product_id']);
        $category_id = $product->category_id;

        // Handle image upload
        if ($request->hasFile('item_image')) {
            $imagePath = $request->file('item_image')->store('Items/images', 'public');
            $validatedData['item_image'] = $imagePath;
        }

        // Create the new item
        Item::create([
            'item_name' => $validatedData['item_name'],
            'item_description' => $validatedData['item_description'],
            'item_price' => $validatedData['item_price'],
            'item_image' => $validatedData['item_image'],
            'product_id' => $validatedData['product_id'],
            'category_id' => $category_id,
        ]);

        return redirect()->route('Items')->with('success', 'Item added successfully.');
    }





    /**
     * Display the specified item.
     */
    public function show(string $id)
    {
        $item = Item::findOrFail($id);

        $categories = Category::pluck('category_name', 'category_id');

        $product = Product::pluck('product_name', 'product_id');
        return view('Items.show', compact('item', 'product', 'categories'));
    }


    /**
     * Show the form for editing the specified item.
     */
    // public function edit(string $id)
    // {

    //     $item = Item::findOrFail($id);
    //     return view('Items.edit', compact('item'));
    // }





    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::pluck('category_name', 'category_id');
        $product = Product::pluck('product_name', 'product_id');

        return view('Items.edit', compact('item', 'product', 'categories'));
    }

    /**
     * Update the specified item in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Item::findOrFail($id);

        $product = Product::findOrFail($request->product_id);
        $category_id = $product->category_id; 

        if ($request->hasFile('image')) {
            if ($item->item_image && Storage::exists('public/' . $item->item_image)) {
                Storage::delete('public/' . $item->item_image);
            }

            $imagePath = $request->file('image')->store('Items/images', 'public');
        } else {
            $imagePath = $item->item_image;
        }

        $item->update([
            'item_name' => $request->item_name,
            'item_price' => $request->item_price,
            'item_description' => $request->description,
            'product_id' => $request->product_id,
            'category_id' => $request->category_id, 
            'item_image' => $imagePath,
        ]);

        return redirect()->route('Items')->with('success', 'Item updated successfully');
    }


    /**
     * Remove the specified item from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);


        $item->delete();

        return redirect()->route('Items')->with('success', 'Item deleted successfully.');
    }

    /**
     * Search for items by name or description.
     */
    public function searrchh(Request $request)
    {
        $query = $request->input('query');

        if ($query) {
            $items = Item::where('item_name', 'LIKE', "%$query%")
                ->orWhere('item_description', 'LIKE', "%$query%")
                ->get();
        } else {
            $items = Item::orderBy('created_at', 'DESC')->paginate(10);
        }

        return view('Items.index', ['items' => $items]);
    }

    /**
     * Return all items for the app layout.
     */

    public function view()
    {
        $items = Item::all();
        return view('item', compact('items'));
    }


    public function showItem($product_id)
    {
        $items = Item::where('product_id', $product_id)->get();
        return view('Item', compact('items'));
    }


    public function detail($id)
    {
        $item = Item::findOrFail($id); 
    
        $user = auth()->user();
    
        if (!$user) {
            $favorites = session()->get('favorites', []);
            $isFavorite = in_array($item->id, $favorites);
        } else {
            $isFavorite = $user->favorites()->where('item_id', $item->id)->exists();
        }
    
        return view('detail', compact('item', 'isFavorite')); 
    }
    
    
    
}
