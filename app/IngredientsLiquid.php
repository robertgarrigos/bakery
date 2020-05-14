<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientsLiquid extends Model
{
    public $table = 'ingredients_liquids';
    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
