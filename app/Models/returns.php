<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class returns extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
