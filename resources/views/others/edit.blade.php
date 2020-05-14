
{{-- @inject('suppliers', 'App\Supplier') --}}

@extends('layouts.admin')

@section('title', 'Edit ingredient other')
@section('content')
<form action="/admin/recipes/{{ $recipe->id }}/ingredients_others/{{ $other->id }}" method="post">
        @method('PATCH')

        @include ('others.form', [
            'buttonText' => 'Update other'
        ])
    </form>

  @include('errors')

@endsection
