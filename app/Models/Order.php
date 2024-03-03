<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function toy()
    {
        return $this->belongsTo(Toys::class, 'toy_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
