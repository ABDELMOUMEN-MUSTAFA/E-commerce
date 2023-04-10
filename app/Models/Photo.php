<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Product;

class Photo extends Model
{
    use HasFactory;

    protected $guard = [];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }
}
