@extends('layouts.admin')

@section('title', 'Recipes')


@section('content')

<a class="button content" href="/admin/recipes/create">Create</a>
  <table class="table is-fullwidth is-hoverable is-striped is-narrow">
    <thead>
      <tr>
        <th>Recipe</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($recipes as $recipe)

        <tr>
            <td><a href="/admin/recipes/{{ $recipe->id }}">{{ $recipe->title }}</a></td>
            <td>
                <a href="/admin/productions/{{ $recipe->id }}/create" class="button is-warning is-small">Create production</a>
                <a href="/admin/recipes/{{ $recipe->id }}/edit" class="button is-success is-small"><i class="fas fa-edit"></i></a>
                <a href="/admin/recipes/{{ $recipe->id }}/duplicate" class="button is-light is-small"><i class="fas fa-copy"></i></a>
                <form method="post" action="/admin/recipes/{{ $recipe->id }}" style="display: inline-block;" onsubmit="return confirm('Do you really want to delete?');">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="button is-danger is-small"><i class="fas fa-trash-alt"></i></button>
                </form>
            </td>
          </tr>

      @endforeach
    </tbody>
  </table>




@endsection
