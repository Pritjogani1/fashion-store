<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category')
                    ->withTimestamps();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
