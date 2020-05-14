
@extends('layouts.admin')

@section('title', $recipe->title)


@section('content')

<div class="columns">
    <div class="column is-8">
        <div class="columns">
            <div class="column">
                <h3 class="is-size-3">Flours <a class="button is-success"
                        href="/admin/recipes/{{ $recipe->id }}/ingredients_flours/create"><i
                            class="fas fa-plus"></i></a></h3>

                <table class="table is-fullwidth is-hoverable is-striped is-narrow">
                    <thead>
                        <tr>
                            <th>Ingredient</th>
                            <th>Weight</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recipe->ingredients_flours as $flour)
                        <tr>
                            <td>{{ $flour->title }}</td>
                            <td>{{ $flour->weight }}</td>
                            <td><a class="button is-success is-small"
                                    href="/admin/recipes/{{ $recipe->id }}/ingredients_flours/{{ $flour->id }}/edit"><i
                                        class="fas fa-edit"></i></a>
                                <form method="post" action="/flours/{{ $flour->id }}" style="display: inline-block;"
                                    onsubmit="return confirm('Do you really want to delete?');">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="button is-danger is-small"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th>{{ $recipe->recipe_flours }}</th>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>

                <h3 class="is-size-3">Others <a class="button is-success"
                        href="/admin/recipes/{{ $recipe->id }}/ingredients_others/create"><i
                            class="fas fa-plus"></i></a></h3>

                <table class="table is-fullwidth is-hoverable is-striped is-narrow">
                    <thead>
                        <tr>
                            <th>Ingredient</th>
                            <th>Weight</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recipe->ingredients_others as $other)
                        <tr>
                            <td>{{ $other->title }}</td>
                            <td>
                                {{ $other->weight }}
                            </td>
                            <td><a class="button is-success is-small"
                                    href="/admin/recipes/{{ $recipe->id }}/ingredients_others/{{ $other->id }}/edit"><i
                                        class="fas fa-edit"></i></a>
                                <form method="post" action="/others/{{ $other->id }}" style="display: inline-block;"
                                    onsubmit="return confirm('Do you really want to delete?');">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="button is-danger is-small"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th>{{ $recipe->recipe_others }}</th>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="column">
                <h3 class="is-size-3">Liquids <a class="button is-success"
                        href="/admin/recipes/{{ $recipe->id }}/ingredients_liquids/create"><i
                            class="fas fa-plus"></i></a></h3>

                <table class="table is-fullwidth is-hoverable is-striped is-narrow">
                    <thead>
                        <tr>
                            <th>Ingredient</th>
                            <th>Weight</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recipe->ingredients_liquids as $liquid)
                        <tr>
                            <td>{{ $liquid->title }}</td>
                            <td>
                                {{ $liquid->weight }}
                            </td>
                            <td><a class="button is-success is-small"
                                    href="/admin/recipes/{{ $recipe->id }}/ingredients_liquids/{{ $liquid->id }}/edit"><i
                                        class="fas fa-edit"></i></a>
                                <form method="post" action="/liquids/{{ $liquid->id }}" style="display: inline-block;"
                                    onsubmit="return confirm('Do you really want to delete?');">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="button is-danger is-small"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th>{{ $recipe->recipe_liquids }}</th>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>



                <h3 class="is-size-3">Sourdoughs <a class="button is-success"
                        href="/admin/recipes/{{ $recipe->id }}/ingredients_sourdoughs/create"><i
                            class="fas fa-plus"></i></a></h3>

                <table class="table is-fullwidth is-hoverable is-striped is-narrow">
                    <thead>
                        <tr>
                            <th>Ingredient</th>
                            <th>Weight</th>
                            <th>Humidity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recipe->ingredients_sourdoughs as $sourdough)
                        <tr>
                            <td>{{ $sourdough->title }}</td>
                            <td>
                                {{ $sourdough->weight }}
                            </td>
                            <td>
                                {{ $sourdough->humidity }}
                            </td>
                            <td><a class="button is-success is-small"
                                    href="/admin/recipes/{{ $recipe->id }}/ingredients_sourdoughs/{{ $sourdough->id }}/edit"><i
                                        class="fas fa-edit"></i></a>
                                <form method="post" action="/sourdoughs/{{ $sourdough->id }}"
                                    style="display: inline-block;"
                                    onsubmit="return confirm('Do you really want to delete?');">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="button is-danger is-small"><i
                                            class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <th>Total</th>
                            <th>{{ $recipe->recipe_sourdoughs }}</th>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="content">
            <div class="card">
              <header class="card-header">
                <p class="card-header-title">
                  Notes    </p>
              </header>
              <div class="card-content">
                <div class="content">
                    @markdown($recipe->notes)
                </div>
              </div>
            </div>

        </div>



    </div>
    <div class="column is-2">

        <div class="card content">
            <div class="card-header">
                <p class="card-header-title">Recipe data</p>
            </div>
            <div class="card-content">
                <p>Recipe flours: {{ $recipe->recipe_flours }}</p>
                <p>Recipe liquids: {{ $recipe->recipe_liquids }}</p>
                <p>Recipe others: {{ $recipe->recipe_others }}</p>
                <p>Recipe recipe: {{ $recipe->recipe_total }}</p>
                <p>Recipe humidity: {{ $recipe->recipe_humidity }}</p>
            </div>
        </div>
        <div class="card content">
            <div class="card-header">
                <p class="card-header-title">Total data</p>
            </div>
            <div class="card-content">
                <p>Total flours: {{ $recipe->total_flours }}</p>
                <p>Total liquids: {{ $recipe->total_liquids }}</p>
                <p>Total others: {{ $recipe->total_others }}</p>
                <p>Total recipe: {{ $recipe->total_total }}</p>
                <p>Total humidity: {{ $recipe->total_humidity }}</p>
            </div>
        </div>

    </div>
    <div class="column is-2">
        <div class="content">
            <calculator></calculator>
        </div>
        <div class="card content">
            <div class="card-header">
                <p class="card-header-title">Actions recipe</p>
            </div>
            <div class="card-content">
                <div class="field is-grouped">
                    <div class="control"><a href="/admin/recipes/{{ $recipe->id }}/edit" class="button is-success"><i
                                class="fas fa-edit"></i></a></div>
                                <div class="control"><a href="/admin/recipes/{{ $recipe->id }}/duplicate" class="button is-light"><i class="fas fa-copy"></i></a></div>
                    <div class="control">
                        <form method="post" action="/admin/recipes/{{ $recipe->id }}"
                            onsubmit="return confirm('Do you really want to delete?');">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="button is-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
