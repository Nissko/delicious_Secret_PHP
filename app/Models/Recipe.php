<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = ['id',
        'name',
        'description',
        'person',
        'img',
        'time',
        'calories',
        'country_id',
        'category_id',
        'user_id',
        'status'
    ];

    public function favorites(){
        return $this->hasMany(Favorite::class);
    }

    public function getAverageRateAttribute() /*Считаем среднюю оценку каждого рецепта*/
    {
        return $this->attributes['average_rate'] = $this->rate->avg('value_rate');
    }

    public function rate(){
        return $this->hasMany(Rate::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function country(){
        return $this->belongsTo(Country::class);
    }

    public function staps(){
        return $this->hasMany(Step::class);
    }

    public function ingredients(){
        return $this->hasMany(Ingredient::class);
    }

    public function ideas(){
        return $this->belongsToMany(Idea::class, 'recipe_idea');
    }

    public function programs(){
        return $this->belongsToMany(Program::class, 'recipe_program');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
