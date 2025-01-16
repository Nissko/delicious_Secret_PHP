<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id', 'step_number', 'description', 'step_img', 'recipe_id'];

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }
}
