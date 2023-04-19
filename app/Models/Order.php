<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\User;
use App\models\OrderStatus;
use App\models\Shipper;
use App\models\Product;

class Order extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function orderStatus()
    {
    	return $this->belongsTo(OrderStatus::class);
    }

    public function products()
    {
    	return $this->belongsToMany(Product::class)->withPivot(['quantity', 'unit_price'])->withTimestamps();
    }

    protected $casts = [
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
        'processed_at' => 'datetime',
        'cancelled_at' => 'datetime'
    ];
}
