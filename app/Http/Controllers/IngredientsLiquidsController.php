<?php

namespace App\Http\Controllers;

use App\IngredientsLiquid;
use Illuminate\Http\Request;
use App\Recipe;

class IngredientsLiquidsController extends Controller
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
        return view('liquids.create', ['recipe' => $recipe]);
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
            'recipe_id' => 'required',
        ]);

        IngredientsLiquid::create($attributes);

        return redirect('/admin/recipes/' . $request['recipe_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IngredientsLiquid  $IngredientsLiquid
     * @return \Illuminate\Http\Response
     */
    public function show(IngredientsLiquid $IngredientsLiquid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IngredientsLiquid  $IngredientsLiquid
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe, IngredientsLiquid $IngredientsLiquid)
    {
        return view('liquids.edit', [
            'recipe' => $recipe,
            'liquid' => $IngredientsLiquid,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IngredientsLiquid  $IngredientsLiquid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe, IngredientsLiquid $IngredientsLiquid)
    {
        $IngredientsLiquid->update($this->validateRequest());

        return redirect('/admin/recipes/' . $recipe->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IngredientsLiquid  $IngredientsLiquid
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$recipe = Recipe::all();
        $liquid = IngredientsLiquid::find($id);
        // dump($id);
        $recipe = $liquid->recipe;
        $liquid->delete();
        //dump($recipe);
        return redirect('/admin/recipes/' . $recipe->id);
    }

    /**
     * Duplicate liquids for a given recipe.
     *
     * @param  \App\Recipe  $id_original
     * @param  \App\Recipe  $id_duplicate
     * @return \Illuminate\Http\Response
     */
    public static function duplicate($id_original, $id_duplicate)
    {
        $liquids = IngredientsLiquid::where('recipe_id', $id_original)->get();

        foreach ($liquids as $liquid) {
            IngredientsLiquid::create([
                'recipe_id' => $id_duplicate,
                'title' => $liquid->title,
                'weight' => $liquid->weight
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
            'recipe_id' => 'required',
        ]);
    }
}
