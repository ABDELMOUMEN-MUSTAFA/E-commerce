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

    protected $guarded = [];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function size()
    {
    	return $this->belongsTo(Size::class);
    }

    public function color()
    {
    	return $this->belongsTo(Color::class);
    }
}
