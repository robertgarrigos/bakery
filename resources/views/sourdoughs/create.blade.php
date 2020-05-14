@extends('layouts.admin')

@section('title', 'Create a new ingredient sourdough')
@section('content')
    <form action="/admin/recipes/{{ $recipe->id }}/ingredients_sourdoughs" method="post">
      @csrf
      @include ('sourdoughs.form', [
          'sourdough' => new App\IngredientsSourdough,
            'buttonText' => 'Create sourdough'
        ])
    </form>

  @include('errors')

@endsection
