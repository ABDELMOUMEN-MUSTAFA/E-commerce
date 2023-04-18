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
use App\models\Review;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'quantity_in_stock',
        'type_product',
        'description',
        'category_id'
    ];

    public function getPriceAttribute($price)
    {
        return '$'.$price;
    }

    // $orders->map(function($order) { return $order->products->map(function($product){ return $product->pivot->product_id; });  })
    
    public function orders()
    {
    	return $this->belongsToMany(Order::class)->withPivot(['quantity', 'unit_price'])->withTimestamps();
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

    public function reviews()
    {
    	return $this->hasMany(Review::class);
    }

    protected $casts = [
        'is_active' => 'boolean',
        'quantity_in_stock' => 'integer'
    ];
}
