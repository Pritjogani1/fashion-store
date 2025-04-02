<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Exception;


class ProductController extends Controller
{
    
    public function allproducts()
    {
        try{
        $products = Product::all();
        return view('admin.admin-products', compact('products'));
        }
        catch(Exception $e) {
            return back()->withErrors([
               'message' => 'An error occurred while fetching the products.',
            ]);
        }
    }
    public function addproduct()
    {
        try{
        $categories = Category::all();
        return view('admin.admin-addproduct', compact('categories'));
        }   
        catch(Exception $e) {
            return back()->withErrors([
               'message' => 'An error occurred while fetching the categories.',
            ]);
        }
    }

    // Change this method name from 'create' to 'store'
    public function store(Request $request)
    {
        try{
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
          
        ]);

        // Attach categories
        $product->categories()->attach($request->categories);

        return redirect()->route('admin.products')->with('success', 'Product added successfully');
        }
        catch(Exception $e) {
            return back()->withErrors([
              'message' => 'An error occurred while adding the product.',
            ]);
        }
    }

    public function editproduct($id)
    {
        try{
        $product = Product::with('categories')->findOrFail($id);
        $categories = Category::all();
        return view('admin.admin-editproduct', compact('product', 'categories'));
        }
        catch(Exception $e) {
            return back()->withErrors([
             'message' => 'An error occurred while fetching the product.',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        try{
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
    catch(Exception $e) {
        return back()->withErrors([
         'message' => 'An error occurred while updating the product.',
        ]); 
    }
}

    public function byCategory(Category $category)
    {
        try{
        $products = $category->products()->paginate(12);
        return view('products.category', compact('category', 'products'));
        }
        catch(Exception $e) {
            return back()->withErrors([
            'message' => 'An error occurred while fetching the products.',              
            ]);
        }    
        }
        

    public function destroy($id)
    {
        try{
        $product = Product::findOrFail($id);
        
        // Delete the product image from storage if it exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        
        // Delete the product and its relationships
        $product->categories()->detach();
        $product->delete();
        
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
    }

catch(Exception $e) {
    return back()->withErrors([
       'message' => 'An error occurred while deleting the product.',
    ]);
}
    }
  
         
    
    public function preview(Product $product)
{
   
    // Check if the product has a category relationship
    if ($product->category) {
        $similarProducts = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
    } else {
        // Fallback to get random products if no category is found
        $similarProducts = Product::where('id', '!=', $product->id)
            ->inRandomOrder()
            ->take(4)
            ->get();
    }

    return view('products.preview', compact('product', 'similarProducts'));
}
}
   