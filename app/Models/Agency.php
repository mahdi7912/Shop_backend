<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'email',
        'image',
        'description'
    ];

    public function images()
    {
        return  $this->morphMany( Image::class ,'imageable' );
    }

    public function tags()
    {
        return  $this->morphMany( Tag::class ,'taggable' );
    }
}
