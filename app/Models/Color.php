<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\model\ProductVariant;

class Color extends Model
{
    use HasFactory;

    protected $guard = [];

    public function productVariants()
    {
    	return $this->hasMany(ProductVariant::class);
    }
}
