
@extends('layouts.admin')


@section('title')Create a new production of {{ $recipe->title }}@endsection

@section('content')
    <form action="/admin/productions" method="post">
      @include ('productions.form', [
          'production' => new App\Production,
            'buttonText' => 'Create production'
        ])
    </form>

  @include('errors')

@endsection
