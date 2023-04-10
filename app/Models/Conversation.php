<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\models\User;
use App\models\ChatMessage;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id_1',
        'user_id_2',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
