<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientsOther extends Model
{
    public $table = 'ingredients_others';
    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
