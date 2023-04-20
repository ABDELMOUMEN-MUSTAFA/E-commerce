<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;
use App\Models\User;

class Address extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $guarded = [];

    public function user()
    {
    	$this->belognsTo(User::class);
    }
}
