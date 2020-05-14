

@extends('layouts.admin')

@section('title', 'Edit ingredient sourdough')
@section('content')
<form action="/admin/recipes/{{ $recipe->id }}/ingredients_sourdoughs/{{ $sourdough->id }}" method="post">
        @method('PATCH')

        @include ('sourdoughs.form', [
            'buttonText' => 'Update sourdough'
        ])
    </form>

  @include('errors')

@endsection
