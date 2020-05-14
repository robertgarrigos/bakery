

@extends('layouts.admin')

@section('title', 'Create a new ingredient liquid')
@section('content')
    <form action="/admin/recipes/{{ $recipe->id }}/ingredients_liquids" method="post">
      @csrf
      @include ('liquids.form', [
          'liquid' => new App\IngredientsLiquid,
            'buttonText' => 'Create liquid'
        ])
    </form>

  @include('errors')

@endsection
