<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    // For SubCategories
    static public function get_data()
    {
            return Self::where('status', 1)->where('status', 1)->get();
    }

    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }

    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }
}
