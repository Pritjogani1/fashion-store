<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',        
        'slug'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category');
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function($category) {
            $products = $category->products;
            
            foreach($products as $product) {
                if($product->categories()->count() === 1) {
                    $product->delete();
                } else {
                    $product->categories()->detach($category->id);
                }
            }
        });
    }
}
