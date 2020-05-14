<?php

namespace App\Http\Controllers;

use App\IngredientsFlour;
use Illuminate\Http\Request;
use App\Recipe;

class IngredientsFloursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Recipe $recipe)
    {
        return view('flours.create', ['recipe' => $recipe]);
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

        IngredientsFlour::create($attributes);

        return redirect('/admin/recipes/' . $request['recipe_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IngredientsFlour  $IngredientsFlour
     * @return \Illuminate\Http\Response
     */
    public function show(IngredientsFlour $IngredientsFlour)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IngredientsFlour  $IngredientsFlour
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe, IngredientsFlour $IngredientsFlour)
    {
        return view('flours.edit', [
            'recipe' => $recipe,
            'flour' => $IngredientsFlour,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IngredientsFlour  $IngredientsFlour
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe, IngredientsFlour $IngredientsFlour)
    {
        $IngredientsFlour->update($this->validateRequest());

        return redirect('/admin/recipes/' . $recipe->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IngredientsFlour  $IngredientsFlour
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flour = IngredientsFlour::find($id);
        $recipe = $flour->recipe;
        $flour->delete();
        return redirect('/admin/recipes/' . $recipe->id);
    }

    /**
     * Duplicate flours for a given recipe.
     *
     * @param  \App\Recipe  $id_original
     * @param  \App\Recipe  $id_duplicate
     * @return \Illuminate\Http\Response
     */
    public static function duplicate($id_original, $id_duplicate)
    {
        $flours = IngredientsFlour::where('recipe_id', $id_original)->get();

        foreach ($flours as $flour) {
            IngredientsFlour::create([
                'recipe_id' => $id_duplicate,
                'title' => $flour->title,
                'weight' => $flour->weight
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
