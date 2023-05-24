<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'remainig',
        'price',
        'pictures'
    ];

    public function category()
    {
        $this->belongsTo(Category::class);
    }

    public function images()
    {
        $this->morphMany( Image::class ,'imageable' );
    }

    public function discounts()
    {
        $this->morphMany( Discount::class ,'discountable' );
    }
}
