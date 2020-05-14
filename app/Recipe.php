<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = [];

    public function ingredients_flours()
    {
        return $this->hasMany(IngredientsFlour::class);
    }

    public function total_flours()
    {
        return $this->ingredients_flours()->get()->pluck('weight')->sum();
    }

    public function ingredients_liquids()
    {
        return $this->hasMany(IngredientsLiquid::class);
    }

    public function total_liquids()
    {
        return $this->ingredients_liquids()->get()->pluck('weight')->sum();
    }

    public function ingredients_others()
    {
        return $this->hasMany(IngredientsOther::class);
    }

    public function total_others()
    {
        return $this->ingredients_others()->get()->pluck('weight')->sum();
    }

    public function ingredients_sourdoughs()
    {
        return $this->hasMany(IngredientsSourdough::class);
    }

    public function total_sourdoughs()
    {
        return $this->ingredients_sourdoughs()->get()->pluck('weight')->sum();
    }

    public function total_flour_sourdoughs()
    {
        $s = $this->ingredients_sourdoughs()->get();
        $flour_sourdoughs = 0;
        foreach ($s as $value) {
            $flour_sourdoughs += $value->weight / (1 + $value->humidity);
        }
        return $flour_sourdoughs;
    }

    public function productions()
    {
        return $this->hasMany(Production::class);
    }
}
