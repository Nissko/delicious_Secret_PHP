<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $fillable = [
        'id',
        'value_rate',
        'recipe_id',
        'user_id',
    ];

    public function recipes(){
        return $this->belongsTo(Recipe::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }
}
