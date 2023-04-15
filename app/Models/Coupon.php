<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Product;

class Coupon extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function setExpirationDateAttribute($expirationDate){
    	$this->attributes['expiration_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $expirationDate)->format('Y-m-d');
    }

    public function setCodeAttribute($code)
    {
    	$this->attributes['code'] = strtoupper($code);
    }

    protected $casts = [
        'expiration_date' => 'date',
        'is_active' => 'boolean'
    ];
}
