@extends('layouts.admin')

@section('title', 'Productions')


@section('content')

<table class="table is-fullwidth is-hoverable is-striped is-narrow">
    <thead>
        <tr>
            <th>Production</th>
            <th>Date</th>
            <th>Status</th>
            <th>Pieces final</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productions as $production)
        <tr class="tr {{ $production->status == 1 ? 'is-danger' : '' }} {{ $production->status == 2 ? 'is-warning' : '' }} {{ $production->status == 3 ? 'is-success' : '' }}">
            <td><a href="/admin/productions/{{ $production->id }}">
                    {{ $production->title }}
                </a></td>
            {{-- <td>{{ $production->created_at-> }}</td> --}}
            <td>{{ $production->created_at->format('D d-m-Y | H:i:s')}}</td>
            <td>@include('includes.status')</td>
            @if (!$production->pieces_final)
            <td>
                <form action="/admin/productions/{{ $production->id }}/pieces_final" method="post" >
                @csrf
                <div class="field has-addons">
                        <div class="control">
                                <input type="text" class="input is-small" size="2" name="pieces_final">

                              </div>
                              <div class="control"><button type="submit" class="button is-small is-info">Set</button></div>
                </div>

                </form>
            </td>
            @else
            <td>{{ $production->pieces_final }}</td>
            @endif

            <td>
                @if ($production->status == 1)
                <form method="post" action="/admin/productions/{{ $production->id }}/mark"   style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="new_status" value="2">
                    <button type="submit" class="button is-small is-warning">Mark fermenting</button>
                </form>
                @endif
                @if ($production->status == 2)
                <form method="post" action="/admin/productions/{{ $production->id }}/mark"   style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="new_status" value="3">
                    <button type="submit" class="button is-small is-success">Mark finished</button>
                </form>
                @endif
                @if ($production->status == 3)
                <form method="post" action="/admin/productions/{{ $production->id }}/mark" style="display: inline-block;">
                    @csrf
                    <input type="hidden" name="new_status" value="1">
                    <button type="submit" class="button is-small is-danger">Mark pending</button>
                </form>
                @endif
                <a class="button is-success is-small" href="/admin/productions/{{ $production->id }}/edit">Edit</a>
                <form method="post" action="/admin/productions/{{ $production->id }}" style="display: inline-block;" onsubmit="return confirm('Do you really want to delete?');">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="button is-danger is-small">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $productions->links() }}
</ul>
@include('errors')

@endsection
