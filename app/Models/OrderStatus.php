<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Order;

class OrderStatus extends Model
{
    use HasFactory;

    protected $guard = [];

    public function order()
    {
    	return $this->hasMany(Order::class);
    }
}
