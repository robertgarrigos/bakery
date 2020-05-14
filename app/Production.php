<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Production extends Model
{
    protected $guarded = [];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    protected $casts = [
        'recipe_data' => 'array',
        'production_data' => 'array'
    ];
}
