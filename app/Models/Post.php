<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function Category()
    {
        return  $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function images()
    {
        return  $this->morphMany( Image::class ,'imageable' );
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = ['image' => 'array'];
}
