<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;

    // For ChildCategories
    static public function get_data()
    {
        return Self::where('status', 1)->where('status', 1)->get();
    }
}
