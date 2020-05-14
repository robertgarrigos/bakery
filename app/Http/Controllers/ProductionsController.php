<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Production;
use App\Recipe;
use Illuminate\Support\Facades\DB;

class ProductionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $productions = DB::table('productions')->orderBy('created_at', 'desc')->paginate(15);
        // $productions = Production::paginate(10)->sortByDesc('created_at');
        $productions = Production::orderBy('created_at', 'desc')->paginate(10);

        // $productions = Production::paginate(10);
        return view('productions.index', ['productions' => $productions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Recipe $recipe)
    {
        return view('productions.create', ['recipe' => $recipe]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // validate form
        $attributes = $this->validateRequest();
        // add title and recipe_id
        $attributes += [
            'title' => $request->title,
            'recipe_id' => $request->recipe_id
        ];
        //add calculations: total_weight, recipe_data, production_data, proportion

        // total_weight (total production weight)
        $total_weight = $request->pieces_number * $request->pieces_weight;
        $attributes += compact('total_weight');

        // recipe_data
        $recipe = Recipe::find($request->recipe_id);

        $ingredients_flours = $recipe->ingredients_flours();
        // dump($ingredients_flours->get()->toArray());
        $flours = $ingredients_flours->get()->except(['created_at'])->toArray();

        $ingredients_liquids = $recipe->ingredients_liquids();
        $liquids = $ingredients_liquids->get()->toArray();

        $ingredients_others = $recipe->ingredients_others();
        $others = $ingredients_others->get()->toArray();

        $ingredients_sourdoughs = $recipe->ingredients_sourdoughs();
        $sourdoughs = $ingredients_sourdoughs->get()->toArray();

        // recipe totals
        $total_flour_sourdoughs = $recipe->total_flour_sourdoughs();
        $total_flours = $recipe->total_flours() + $total_flour_sourdoughs;
        $total_liquids = $recipe->total_liquids() + ($recipe->total_sourdoughs() - $total_flour_sourdoughs);
        $total_others = $recipe->total_others();
        $total_total = $total_flours + $total_liquids + $total_others;

        $recipe_data = compact('flours', 'liquids', 'others', 'sourdoughs', 'total_flours', 'total_liquids', 'total_others', 'total_total');
        $attributes += compact('recipe_data');

        // proportion calculation
        $proportion = $total_weight / $total_total;
        $attributes += compact('proportion');

        // production_data
        $flours = $ingredients_flours->get();
        foreach ($flours as $flour) {
            $flour->weight = (float)number_format($flour->weight * $proportion, 2, ".", "");
            unset($flour->created_at);
            unset($flour->updated_at);
            unset($flour->recipe_id);
        }

        $liquids = $ingredients_liquids->get();
        foreach ($liquids as $liquid) {
            $liquid->weight = (float)number_format($liquid->weight * $proportion, 2, ".", "");
            unset($liquid->created_at);
            unset($liquid->updated_at);
            unset($liquid->recipe_id);
        }

        $others = $ingredients_others->get();
        foreach ($others as $other) {
            $other->weight = (float)number_format($other->weight * $proportion, 2, ".", "");
            unset($other->created_at);
            unset($other->updated_at);
            unset($other->recipe_id);
        }

        $sourdoughs = $ingredients_sourdoughs->get();
        foreach ($sourdoughs as $sourdough) {
            $sourdough->weight = (float)number_format($sourdough->weight * $proportion, 2, ".", "");
            unset($sourdough->created_at);
            unset($sourdough->updated_at);
            unset($sourdough->recipe_id);
        }

        $production_data = compact(
            'flours',
            'liquids',
            'others',
            'sourdoughs'
        );
        $attributes += compact('production_data');

        Production::create($attributes);

        return redirect('/admin/productions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $production = Production::findOrFail($id);
        return view('productions.show', ['production' => $production]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Production $production)
    {
        return view('productions.edit', [
            'production' => $production,
            'recipe' => Recipe::findOrFail($production->recipe_id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $production = Production::findOrFail($id);
        $production->update($this->validateRequest());
        $this->calc($production);
        return redirect('/admin/productions/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Production::findOrFail($id)->delete();
        return redirect('/admin/productions');
    }

    /**
     * Validate the request attributes.
     *
     * @return array
     */
    protected function validateRequest()
    {
        return request()->validate([
            'pieces_number' => ['numeric'],
            'pieces_weight' => ['numeric'],
            'pieces_final' => 'nullable|numeric',
            'notes' => 'present'
        ]);
    }

    /**
     * Mark a production as next status
     * 1 = pending
     * 2 = fermenting
     * 3 = finished
     * After finshed it goes to pending again
     */
    public function mark(Request $request, $id)
    {

        Production::findOrFail($id)->update(['status' => $request->new_status]);
        return back();


    }

    /**
     * Update pieces_final for a production
     */
    public function piecesFinal(Request $request, $production_id)
    {
        Production::findOrFail($production_id)->update(
            $request->validate([
                'pieces_final' => 'nullable|numeric',
            ])
        );
        return back();
    }

    /**
     * Recalc production quantities, usually because the number
     * of pieces and/or their weight have been updated
     */
    protected function calc(Production $production)
    {
        $recipe_weight = $production->recipe_data['total_total'];
        $production_weight = $production->pieces_weight * $production->pieces_number;
        $proportion = $production_weight / $recipe_weight;

        $flours = $production->production_data['flours'];
        foreach ($flours as $key => $flour) {
            $flours[$key]['weight'] = (float)number_format($production->recipe_data['flours'][$key]['weight'] * $proportion, 2, ".", "");
        }

        $liquids = $production->production_data['liquids'];
        foreach ($liquids as $key => $liquid) {
            $liquids[$key]['weight'] = (float)number_format($production->recipe_data['liquids'][$key]['weight'] * $proportion, 2, ".", "");
        }

        $others = $production->production_data['others'];
        foreach ($others as $key => $other) {
            $others[$key]['weight'] = (float)number_format($production->recipe_data['others'][$key]['weight'] * $proportion, 2, ".", "");
        }

        $sourdoughs = $production->production_data['sourdoughs'];
        foreach ($sourdoughs as $key => $sourdough) {
            $sourdoughs[$key]['weight'] = (float)number_format($production->recipe_data['sourdoughs'][$key]['weight'] * $proportion, 2, ".", "");
        }

        $production_data = compact(
            'flours',
            'liquids',
            'others',
            'sourdoughs'
        );

        $attributes = compact ('production_data', 'proportion');
        $attributes += ['total_weight' => $production_weight];
        $production->update($attributes);
    }
}
