<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'client_name',
        'client_address',
        'factor_code'
    ];

    public function products()
    {
        $this->hasMany(Product::class);
    }
}
