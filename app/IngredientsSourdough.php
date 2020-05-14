<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientsSourdough extends Model
{
    public $table = 'ingredients_sourdoughs';
    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
