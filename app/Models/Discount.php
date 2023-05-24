<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'discount'
    ];

    public function product()
    {
        $this->hasMany(Product::class);
    }
    public function category()
    {
        $this->hasMany(Category::class);
    }
}
