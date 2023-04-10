<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Order;
use App\models\ShoppingCart;
use App\models\Category;
use App\models\Photo;
use App\models\ProductVariant;
use App\models\Promotion;
use App\models\Coupon;
use App\models\File;

class Product extends Model
{
    use HasFactory;

    public function orders()
    {
    	return $this->belongsToMany(Order::class);
    }

    public function shoppingCarts()
    {
    	return $this->hasMany(ShoppingCart::class);
    }

    public function category()
    {
    	return $this->belongsTo(Category::class);
    }

    public function photos()
    {
    	return $this->hasMany(Photo::class);
    }

    public function productVariants()
    {
    	return $this->hasMany(ProductVariant::class);
    }

    public function promotions()
    {
    	return $this->hasMany(Promotion::class);
    }

    public function coupons()
    {
    	return $this->hasMany(Coupon::class);
    }

    public function files()
    {
    	return $this->hasMany(File::class);
    }
}
