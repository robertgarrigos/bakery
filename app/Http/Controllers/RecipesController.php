<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Http\Request;

class RecipesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', ['recipes' => $recipes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $this->validateRequest();

        $recipe = Recipe::create($attributes);

        return redirect('/admin/recipes/' . $recipe->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        $this->calc($recipe, false);
        return view('recipes.show', compact('recipe'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        return view('recipes.edit', [
            'recipe' => $recipe,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        $recipe->update($this->validateRequest());
        //return $this->calc($recipe);
        return redirect('/admin/recipes/' . $recipe->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Recipe::findOrFail($id)->delete();
        return redirect('/admin/recipes');
    }

    /**
     * Validate the request attributes.
     *
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'title' => ['required'], //validation rules can be members of an array
            'notes' => 'present'
        ]);
    }

    /**
     * Duplicate recipe.
     *
     * @param  \App\Recipe  $id
     * @return \Illuminate\Http\Response
     */
    public function duplicate($id)
    {
        $recipe = Recipe::findOrFail($id);
        $new_recipe = $recipe->replicate();
        $new_recipe->save();

        IngredientsFloursController::duplicate($recipe->id, $new_recipe->id);
        IngredientsOthersController::duplicate($recipe->id, $new_recipe->id);
        IngredientsLiquidsController::duplicate($recipe->id, $new_recipe->id);
        IngredientsSourdoughsController::duplicate($recipe->id, $new_recipe->id);

        return redirect('/admin/recipes/' . $new_recipe->id);
    }

    public function calc(Recipe $recipe, $back = true)
    {
        // calcular total de farines
        $flours = $recipe->ingredients_flours->all();
        $recipe_flours = 0;
        foreach ($flours as $flour) {
            $recipe_flours += $flour->weight;
        }

        // calcular total de liquids
        $liquids = $recipe->ingredients_liquids->all();
        $recipe_liquids = 0;
        foreach ($liquids as $liquid) {
            $recipe_liquids += $liquid->weight;
        }

        // calcular total d'altres
        $others = $recipe->ingredients_others->all();
        $recipe_others = 0;
        foreach ($others as $other) {
            $recipe_others += $other->weight;
        }

        // calcular total de mm i farina de mm
        $sourdoughs = $recipe->ingredients_sourdoughs->all();
        $recipe_sourdoughs = 0;
        $flour_sourdoughs = 0;
        foreach ($sourdoughs as $sourdough) {
            $recipe_sourdoughs += $sourdough->weight;
            $flour_sourdoughs += $sourdough->weight / (1 + $sourdough->humidity);
        }

        $recipe_total = $recipe_flours + $recipe_sourdoughs + $recipe_others + $recipe_liquids;
        // calcular totals de recepta
        $total_flours = $recipe_flours + $flour_sourdoughs;
        $total_liquids = $recipe_liquids + ($recipe_sourdoughs - $flour_sourdoughs);
        $total_others = $recipe_others;
        $total_total = $total_flours + $total_liquids + $total_others;

        // humudity calcs
        if ($recipe_flours > 0) {
            $recipe_humidity = number_format(($recipe_liquids / $recipe_flours), 2, '.', '');
            $total_humidity = number_format(($total_liquids / $total_flours), 2, '.', '');
        } else {
            $recipe_humidity = 0;
            $total_humidity = 0;
        }

        // guardar valors de recipe
        $values = compact(
            'recipe_flours',
            'recipe_liquids',
            'recipe_sourdoughs',
            'recipe_others',
            'recipe_total',
            'total_flours',
            'total_liquids',
            'total_others',
            'total_total',
            'recipe_humidity',
            'total_humidity'
        );
        $recipe->update($values);

        // tornar a vista de recepta
        if ($back) {
            return back();
        }
    }
}
