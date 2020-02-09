<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Monitor extends Model
{
    protected $fillable = [
        'product_id',
        'price'
    ];
}
