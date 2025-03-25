<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        try {
        $categories = Category::all();
        return view('admin.admin-categories', compact('categories'));
    }
    catch(\Exception $e) {
        return back()->withErrors([
           'message' => 'An error occurred while fetching the categories.',
        ]   );
    }
    }

    public function store(Request $request)
    {
        try {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('success', 'Category created successfully');
    }
    catch(\Exception $e) {
        return back()->withErrors([
            'message' => 'An error occurred while creating the category.',
        ]);
    }
    }   

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->save();

        return redirect()->back()->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
