
{{-- @inject('suppliers', 'App\Supplier') --}}

@extends('layouts.admin')

@section('title', 'Edit ingredient liquid')
@section('content')
<form action="/admin/recipes/{{ $recipe->id }}/ingredients_liquids/{{ $liquid->id }}" method="post">
        @method('PATCH')

        @include ('liquids.form', [
            'buttonText' => 'Update liquid'
        ])
    </form>

  @include('errors')

@endsection
