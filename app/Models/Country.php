<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Address;

class Country extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function Addresses()
    {
    	return $this->hasMany(Address::class);
    }
}
