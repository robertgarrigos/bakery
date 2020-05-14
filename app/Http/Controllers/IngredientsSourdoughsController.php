<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\IngredientsSourdough;

class IngredientsSourdoughsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Recipe $recipe)
    {
        return view('sourdoughs.create', ['recipe' => $recipe]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'min:3'], //validation rules can be members of an array
            'weight' => ['required', 'numeric'],
            'humidity' => ['required', 'numeric'],
            'recipe_id' => 'required',
        ]);

        IngredientsSourdough::create($attributes);

        return redirect('/admin/recipes/' . $request['recipe_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe, IngredientsSourdough $IngredientsSourdough)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe, IngredientsSourdough $IngredientsSourdough)
    {
        return view('sourdoughs.edit', [
            'recipe' => $recipe,
            'sourdough' => $IngredientsSourdough,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Recipe $recipe, IngredientsSourdough $IngredientsSourdough)
    {
        $IngredientsSourdough->update($this->validateRequest());

        return redirect('/admin/recipes/' . $recipe->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$recipe = Recipe::all();
        $sourdough = IngredientsSourdough::find($id);
        // dump($id);
        $recipe = $sourdough->recipe;
        $sourdough->delete();
        //dump($recipe);
        return redirect('/admin/recipes/' . $recipe->id);
    }

    /**
     * Duplicate sourdoughs for a given recipe.
     *
     * @param  \App\Recipe  $id_original
     * @param  \App\Recipe  $id_duplicate
     * @return \Illuminate\Http\Response
     */
    public static function duplicate($id_original, $id_duplicate)
    {
        $sourdougs = IngredientsSourdough::where('recipe_id', $id_original)->get();

        foreach ($sourdougs as $sourdoug) {
            IngredientsSourdough::create([
                'recipe_id' => $id_duplicate,
                'title' => $sourdoug->title,
                'weight' => $sourdoug->weight,
                'humidity' => $sourdoug->humidity
            ]);
        }
    }

    /**
     * Validate the request attributes.
     *
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'title' => ['required', 'min:3'], //validation rules can be members of an array
            'weight' => ['required', 'numeric'],
            'humidity' => ['required', 'numeric'],
            'recipe_id' => 'required',
        ]);
    }
}
