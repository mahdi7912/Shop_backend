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
        'category_id',
        'image',
        'discount'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany( Image::class ,'imageable' );
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function discounts()
    {
        return $this->morphMany( Discount::class ,'discountable' );
    }
}
