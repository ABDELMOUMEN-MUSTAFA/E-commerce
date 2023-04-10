<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Payment;
use App\models\User;

class Invoice extends Model
{
    use HasFactory;
    
    protected $guard = [];

    public function payment()
    {
    	return $this->hasOne(Payment::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
