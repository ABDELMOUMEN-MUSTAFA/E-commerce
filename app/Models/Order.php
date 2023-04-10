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

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function orderStatus()
    {
    	return $this->belongsTo(OrderStatus::class);
    }

    public function shipper()
    {
    	return $this->belongsTo(Shipper::class);
    }

    public function products()
    {
    	return $this->belongsToMany(Product::class);
    }
}
