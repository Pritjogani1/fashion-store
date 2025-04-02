<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        
        $products = Product::where('name', 'LIKE', "%{$query}%")
            ->take(5)
            ->get(['id', 'name', 'price', 'image','slug']);

        return response()->json($products);
    }

    public function showResults($keyword)
    {
        $products = Product::where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('description', 'LIKE', "%{$keyword}%")
            ->paginate(12);

        $similarProducts = Product::where('name', 'LIKE', "%{$keyword}%")
            ->orWhere('description', 'LIKE', "%{$keyword}%")
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('search-results', compact('products', 'keyword', 'similarProducts'));
    }
}