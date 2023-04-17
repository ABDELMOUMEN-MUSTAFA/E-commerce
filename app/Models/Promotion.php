<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\Product;

class Promotion extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function product()
    {
    	return $this->belongsTo(Product::class);
    }

    public function setStartDateAttribute($startDate)
    {
    	$this->attributes['start_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $startDate)->format('Y-m-d');
    }

    public function setEndDateAttribute($endDate)
    {
    	$this->attributes['end_date'] = \Carbon\Carbon::createFromFormat('m/d/Y', $endDate)->format('Y-m-d');
    }

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];
}
