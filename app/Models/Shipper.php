<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Order;

class Shipper extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function orders()
    {
    	return $this->hasMany(Order::class);
    }
}
