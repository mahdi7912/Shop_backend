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
        'email'
    ];

    public function images()
    {
        $this->morphMany( Image::class ,'imageable' );
    }


}