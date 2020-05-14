
@inject('productions', 'App\Production')

@extends('layouts.admin')

@section('title', 'Edit production: ' . $production->title)
@section('content')
<form action="/admin/productions/{{ $production->id }}" method="post">
        @method('PATCH')
        @include ('productions.form', [
            'buttonText' => 'Update production'
        ])
    </form>

  @include('errors')

@endsection
