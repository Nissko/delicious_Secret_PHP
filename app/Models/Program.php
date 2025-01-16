<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'name', 'description', 'day', 'calories', 'price', 'old_price', 'program_file'];

    public function recipes(){
        return $this->belongsToMany(Recipe::class, 'recipe_program');
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }
}
