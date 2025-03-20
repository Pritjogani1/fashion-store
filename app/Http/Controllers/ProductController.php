<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    public function allproducts()
    {
        $products = Product::all();
        return view('admin.admin-products', compact('products'));
    }
    public function addproduct()
    {
        $categories = Category::all();
        return view('admin.admin-addproduct', compact('categories'));
    }

    // Change this method name from 'create' to 'store'
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'slug' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $image = $request->file('image');
        $imagePath = $image->store('products', 'public');

        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'slug' => $request->slug,
            'image' => $imagePath,
            'description' => $request->description,
            'sub_category' => $request->sub_category
        ]);

        // Attach categories
        $product->categories()->attach($request->categories);

        return redirect()->route('admin.products')->with('success', 'Product added successfully');
    }

    public function editproduct($id)
    {
        $product = Product::with('categories')->findOrFail($id);
        $categories = Category::all();
        return view('admin.admin-editproduct', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $validatedData = $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'categories' => 'array|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }
    
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description
        ]);
    
        // Sync categories
        $product->categories()->sync($request->categories ?? []);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }

    public function byCategory(Category $category)
    {
        $products = $category->products()->paginate(12);
        return view('products.category', compact('category', 'products'));
    }
}
   