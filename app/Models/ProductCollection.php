<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCollection extends Model
{
    //

    protected $fillable = [
        'collect_id',
        'product_id',
        'name',
        'qty',
    ];
}
