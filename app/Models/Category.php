<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcategory;

class Category extends Model
{
    use HasFactory;

    // For Categories
    static public function get_data()
    {
        return Self::where('status', 1)->get();
    }

    public function subCategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // public function subcategories()
    // {
    //     return $this->hasMany(Subcategory::class);
    // }
}
