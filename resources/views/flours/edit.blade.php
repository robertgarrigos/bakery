

@extends('layouts.admin')

@section('title', 'Edit ingredient flour')
@section('content')
<form action="/admin/recipes/{{ $recipe->id }}/ingredients_flours/{{ $flour->id }}" method="post">
        @method('PATCH')

        @include ('flours.form', [
            'buttonText' => 'Update flour'
        ])
    </form>

  @include('errors')

@endsection
