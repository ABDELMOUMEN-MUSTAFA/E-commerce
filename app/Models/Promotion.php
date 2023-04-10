<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Product;

class Promotion extends Model
{
    use HasFactory;

    protected $guard = [];

    public function product()
    {
    	return $this->belogsTo(Product::class);
    }
}
