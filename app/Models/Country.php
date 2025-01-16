<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['id', 'name'];

    public function recipes(){
        return $this->hasMany(Recipe::class);
    }
}
