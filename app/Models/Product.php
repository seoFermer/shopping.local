<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'title',
      'description',
      'price'
    ];

    protected $perPage = 10;

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
}
