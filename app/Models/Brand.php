<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    static public function get_data()
    {
        return Self::where('status', 1)->get();
    }

    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }

}
