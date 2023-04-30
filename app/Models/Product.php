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
use App\models\User;

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

    protected $appends = ['discount'];

    public function getDiscountAttribute()
    {
        foreach ($this->promotions as $promotion) {
            if($promotion->end_date >= now()){
                return $promotion->discount;
            }
            return null;
        }
    }

    public function getPriceAttribute($price)
    {
        return '$'.$price;
    }
    
    public function orders()
    {
    	return $this->belongsToMany(Order::class)->withPivot(['quantity', 'unit_price'])->withTimestamps();
    }

    public function users()
    {
    	return $this->belongsToMany(User::class)->withPivot(['quantity'])->withTimestamps();
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
