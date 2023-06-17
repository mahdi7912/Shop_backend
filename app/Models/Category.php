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
        return $this->hasMany(Product::class);
    }
    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function images()
    {
        return  $this->morphMany( Image::class ,'imageable' );
    }

    public function discount()
    {
        return $this->morphOne( Discount::class ,'discountable' );
    }
}
