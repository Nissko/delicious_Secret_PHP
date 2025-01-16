<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Idea extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id', 'name', 'description'];

    public function recipes(){
        return $this->belongsToMany(Recipe::class, 'recipe_idea');
    }
}
