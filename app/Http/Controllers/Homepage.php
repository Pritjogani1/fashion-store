<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class Homepage extends Controller
{
    public function index()
    {
        return view('store.home');
    }
    public function men($category = null)
    {
        $query = Product::whereHas('categories', function($q) {
            $q->where('name', 'Men');
        });
    
        if ($category) {
            $query->whereHas('categories', function($q) use ($category) {
                $q->where('name', $category);
            });
        }
    
        $products = $query->latest()->get();
        $categories = Category::whereHas('products', function($q) {
            $q->whereHas('categories', function($sq) {
                $sq->where('name', 'Men');
            });
        })->get();
    
        return view('store.men', compact('products', 'categories'));
    }
    public function women($category = null)
    {
        $query = Product::whereHas('categories', function($q) {
            $q->where('name', 'Women');
        });
    
        if ($category) {
            $query->whereHas('categories', function($q) use ($category) {
                $q->where('name', $category);
            });
        }
    
        $products = $query->latest()->get();
        $categories = Category::whereHas('products', function($q) {
            $q->whereHas('categories', function($sq) {
                $sq->where('name', 'Women');
            });
        })->get();
    
        return view('store.women', compact('products', 'categories'));
    }
    public function children($category = null)
    {
        $query = Product::whereHas('categories', function($q) {
            $q->where('name', 'Children');
        });
    
        if ($category) {
            $query->whereHas('categories', function($q) use ($category) {
                $q->where('name', $category);
            });
        }
    
        $products = $query->latest()->get();
        $categories = Category::whereHas('products', function($q) {
            $q->whereHas('categories', function($sq) {
                $sq->where('name', 'Children');
            });
        })->get();
    
        return view('store.children', compact('products', 'categories'));
    }
    public function cart()
    {
        return view('store.cart');
    }
    public function about()
    {
        return view('store.about');
    }
}
