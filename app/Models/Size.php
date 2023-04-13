<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\ProductVariant;

class Size extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function productVariants()
    {
    	return $this->hasMany(ProductVariant::class);
    }
}
