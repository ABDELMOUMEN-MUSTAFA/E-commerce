<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\User;

class Review extends Model
{
    use HasFactory;

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    // public function orderProduct()
    // {
    // 	return $this->hasOne(OrderProduct)
    // }
}
