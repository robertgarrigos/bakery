@extends('layouts.admin')

@section('title', 'Create a new ingredient flour')
@section('content')
    <form action="/admin/recipes/{{ $recipe->id }}/ingredients_flours" method="post">
      @csrf
      @include ('flours.form', [
          'flour' => new App\IngredientsFlour,
            'buttonText' => 'Create flour'
        ])
    </form>

  @include('errors')

@endsection
