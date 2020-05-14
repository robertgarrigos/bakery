

@extends('layouts.admin')

@section('title', 'Create a new ingredient other')
@section('content')
    <form action="/admin/recipes/{{ $recipe->id }}/ingredients_others" method="post">
      @csrf
      @include ('others.form', [
          'other' => new App\IngredientsOther,
            'buttonText' => 'Create other'
        ])
    </form>

  @include('errors')

@endsection
