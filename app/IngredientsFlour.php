<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientsFlour extends Model
{
    public $table = 'ingredients_flours';

    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
