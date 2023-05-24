<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function products()
    {
       $this->hasMany(Product::class);
    }
    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
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
