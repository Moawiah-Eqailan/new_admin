<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->get();

        return view('admin.Categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('Categories/images', 'public');
            $validatedData['category_image'] = $imagePath;
        } else {
            $validatedData['category_image'] = null;  
        }

        Category::create($validatedData);

        return redirect()->route('Categories')->with('success', 'Category added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $category_id)
    {
        $category = Category::findOrFail($category_id);

        return view('admin.Categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $category_id)
    {
        $category = Category::findOrFail($category_id);
        return view('admin.Categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $category_id)
    {
        $category = Category::findOrFail($category_id);

        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            if ($category->category_image && Storage::exists('public/' . $category->category_image)) {
                Storage::delete('public/' . $category->category_image);
            }

            $imagePath = $request->file('image')->store('Categories/images', 'public');
        } else {
            $imagePath = $category->category_image; 
        }

        $category->update([
            'category_name' => $validatedData['category_name'],
            'category_image' => $imagePath,
        ]);

        return redirect()->route('Categories')->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $category_id)
    {
        $category = Category::findOrFail($category_id);

        if ($category->category_image && Storage::exists('public/' . $category->category_image)) {
            Storage::delete('public/' . $category->category_image);
        }

        $category->delete();

        return redirect()->route('Categories')->with('success', 'Category deleted successfully');
    }

    public function searchh(Request $request)
    {
        $query = $request->input('query');

        $categories = Category::where('category_id', $query)
            ->orWhere('category_name', 'LIKE', "%$query%")
            ->get();

        return view('admin.Categories.index', ['categories' => $categories]);
    }

    public function app()
    {
        $categories = Category::all();
        return view('UsersPage.layouts.app', compact('categories'));
    }
}
