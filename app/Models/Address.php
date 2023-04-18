<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\User;

class Address extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function country()
    {
    	$this->belognsTo(Country::class);
    }

    public function user()
    {
    	$this->belognsTo(User::class);
    }
}
