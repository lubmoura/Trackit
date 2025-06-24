<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['game_title', 'rating', 'comment', 'user_id'];
    
}
