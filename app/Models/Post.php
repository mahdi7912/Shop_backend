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
        $this->belongsTo(Category::class);
    }
    public function tags()
    {
        $this->morphMany( Tag::class ,'taggable' );
    }

    public function images()
    {
        $this->morphMany( Image::class ,'imageable' );
    }

    public function User()
    {
        $this->belongsTo(User::class);
    }
}
