<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description'
    ];

    public function Category()
    {
        $this->belongsTo(Category::class);
    }
    public function User()
    {
        $this->belongsTo(User::class);
    }
}
