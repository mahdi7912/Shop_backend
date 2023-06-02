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
        'remaining',
        'price',
        'pictures',
        'category_id'
    ];

    public function category()
    {
        $this->belongsTo(Category::class);
    }

    public function images()
    {
        $this->morphMany( Image::class ,'imageable' );
    }

    public function tags()
    {
        $this->morphMany( Tag::class ,'taggable' );
    }

    public function discounts()
    {
        $this->morphMany( Discount::class ,'discountable' );
    }
}
