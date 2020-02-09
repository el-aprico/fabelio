<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'url',
        'name',
        'brand',
        'description',
        'sku',
        'price',
        'image'
    ];
}
