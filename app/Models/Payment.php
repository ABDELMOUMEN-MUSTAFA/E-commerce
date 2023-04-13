<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Invoice;
use App\models\PaymentMethod;
use App\models\User;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function invoice()
    {
    	return $this->hasOne(Invoice::class);
    }

    public function paymentMethod()
    {
    	return $this->belongTo(PaymentMethod::class);
    }

    public function user()
    {
    	return $this->belongTo(User::class);
    }
}
