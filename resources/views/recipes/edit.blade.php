
@inject('recipes', 'App\Recipe')

@extends('layouts.admin')

@section('title', 'Edit recipe: ' . $recipe->title)
@section('content')
<form action="/admin/recipes/{{ $recipe->id }}" method="post">
        @method('PATCH')
        @include ('recipes.form', [
            'buttonText' => 'Update recipe'
        ])
    </form>

  @include('errors')

@endsection
