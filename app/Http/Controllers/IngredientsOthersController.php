<?php

namespace App\Http\Controllers;

use App\IngredientsOther;
use Illuminate\Http\Request;
use App\Recipe;

class IngredientsOthersController extends Controller
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
        return view('others.create', ['recipe' => $recipe]);
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

        IngredientsOther::create($attributes);

        return redirect('/admin/recipes/' . $request['recipe_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\IngredientsOther  $IngredientsOther
     * @return \Illuminate\Http\Response
     */
    public function show(IngredientsOther $IngredientsOther)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\IngredientsOther  $IngredientsOther
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe, IngredientsOther $IngredientsOther)
    {
        return view('others.edit', [
            'recipe' => $recipe,
            'other' => $IngredientsOther,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\IngredientsOther  $IngredientsOther
     * @return \Illuminate\Http\Response
     */
    public function update(Recipe $recipe, IngredientsOther $IngredientsOther)
    {
        $IngredientsOther->update($this->validateRequest());

        return redirect('/admin/recipes/' . $recipe->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\IngredientsOther  $IngredientsOther
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$recipe = Recipe::all();
        $other = IngredientsOther::find($id);
        // dump($id);
        $recipe = $other->recipe;
        $other->delete();
        //dump($recipe);
        return redirect('/admin/recipes/' . $recipe->id);
    }

    /**
     * Duplicate others for a given recipe.
     *
     * @param  \App\Recipe  $id_original
     * @param  \App\Recipe  $id_duplicate
     * @return \Illuminate\Http\Response
     */
    public static function duplicate($id_original, $id_duplicate)
    {
        $others = IngredientsOther::where('recipe_id', $id_original)->get();

        foreach ($others as $other) {
            IngredientsOther::create([
                'recipe_id' => $id_duplicate,
                'title' => $other->title,
                'weight' => $other->weight
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
