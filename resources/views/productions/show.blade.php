@extends('layouts.admin')

@section('title', $production->title .' - '. $production->created_at)

@section('content')

<div class="columns">
    <div class="column is-half">
        <table
            class="table is-striped is-hoverable is-fullwidth is-narrow {{ $production->status == 2 ? 'is-warning' : '' }} {{ $production->status == 3 ? 'is-success' : '' }}">
            <thead>
                <tr>
                    <th>Recipe</th>
                    <th>Ingredient</th>
                    <th>Production</th>
                </tr>
            </thead>
            <tbody>
                @if ($production->production_data['flours'])
                @foreach ($production->production_data['flours'] as $key => $flour)
                <tr>
                    <td>{{ $production->recipe_data['flours'][$key]['weight'] }}</td>
                    <td>{{ $flour['title'] }}</td>
                    <td>{{ $flour['weight'] }}</td>
                </tr>
                @endforeach

                @foreach ($production->production_data['others'] as $key => $other)
                <tr>
                    <td>{{ $production->recipe_data['others'][$key]['weight'] }}</td>
                    <td>{{ $other['title'] }}</td>
                    <td>{{ $other['weight'] }}</td>
                </tr>
                @endforeach

                @foreach ($production->production_data['liquids'] as $key => $liquid)
                <tr>
                    <td>{{ $production->recipe_data['liquids'][$key]['weight'] }}</td>
                    <td>{{ $liquid['title'] }}</td>
                    <td>{{ $liquid['weight'] }}</td>
                </tr>
                @endforeach

                @foreach ($production->production_data['sourdoughs'] as $key => $sourdough)
                <tr>
                    <td>{{ $production->recipe_data['sourdoughs'][$key]['weight'] }}</td>
                    <td>{{ $sourdough['title'] }}</td>
                    <td>{{ $sourdough['weight'] }}</td>
                </tr>
                @endforeach
                <tr>
                    <th>{{ $production->recipe_data['total_total'] }}</th>
                    <th>Total</th>
                    <th>{{ $production->total_weight }}</th>
                </tr>
                @endif


            </tbody>
        </table>
    </div>
    <div class="column is-half">

            <div class="card content">
                    <div class="card-header">
                        <p class="card-header-title">Actions</p>
                    </div>
                    <div class="card-content">
                        <div class="field is-grouped">
                            @if ($production->status == 1)
                            <div class="control">
                                <form method="post" action="/admin/productions/{{ $production->id }}/mark">
                                    @csrf
                                    <input type="hidden" name="new_status" value="2">
                                    <button type="submit" class="button is-warning">Mark fermenting</button>
                                </form>
                            </div>
                            @endif
                            @if ($production->status == 2)
                            <div class="control">
                                <form method="post" action="/admin/productions/{{ $production->id }}/mark">
                                    @csrf
                                    <input type="hidden" name="new_status" value="3">
                                    <button type="submit" class="button is-success">Mark finished</button>
                                </form>
                            </div>
                            @endif
                            @if ($production->status == 3)
                            <div class="control">
                                <form method="post" action="/admin/productions/{{ $production->id }}/mark">
                                    @csrf
                                    <input type="hidden" name="new_status" value="1">
                                    <button type="submit" class="button is-danger">Mark pending</button>
                                </form>
                            </div>
                            @endif
                            <div class="control">
                                <form method="post" action="/admin/productions/{{ $production->id }}"
                                    onsubmit="return confirm('Do you really want to delete?');" class="mt-3">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="button is-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

        <div class="card content is-fullwidth">
            <div class="card-header">
                <p class="card-header-title">Totals</p>
            </div>
            <div class="card-content">
                    @if ($production->status == 1)
                    <p class="has-background-danger has-text-white">Status: pending</p>
                    @endif
                    @if ($production->status == 2)
                    <p class="has-background-warning">Status: fermenting</p>
                    @endif
                    @if ($production->status == 3)
                    <p class="has-background-success">Status: finished</p>
                    @endif
                <p>Total pieces: {{ $production->pieces_number }}</p>
                <p>Weight pieces: {{ $production->pieces_weight }}</p>
                <p>Total weight: {{ $production->total_weight }}</p>
                <p>Proportion: {{ $production->proportion }}</p>
                <p>Final pieces baked: {{ $production->pieces_final }}</p>
                <p>Notes: {{ $production->notes }}</p>
                <a class="button is-success" href="/admin/productions/{{ $production->id }}/edit">Edit</a>
            </div>
        </div>


    </div>
</div>
@endsection
