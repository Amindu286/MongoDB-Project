<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
        'last_ordered_date' => 'datetime', // Automatically cast to Carbon instance
    ];
}
