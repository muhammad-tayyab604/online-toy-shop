<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toys extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
