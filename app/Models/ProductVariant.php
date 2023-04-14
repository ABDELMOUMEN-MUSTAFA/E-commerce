<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Product;
use App\models\Size;
use App\models\Color;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'product_id',
        'color_id'
    ];

    public function getPriceAttribute($price)
    {
        return '$'.$price;
    }

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function sizes()
    {
    	return $this->belongsToMany(Size::class);
    }

    public function color()
    {
    	return $this->belongsTo(Color::class);
    }
}
