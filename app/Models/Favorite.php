<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    protected $fillable = [
        'id',
        'recipe_id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
