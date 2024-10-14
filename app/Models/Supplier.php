<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function returns()
    {
        return $this->hasMany(Returns::class);
    }
}
