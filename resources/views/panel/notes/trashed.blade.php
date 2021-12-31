@extends('layouts.panel')
@section('title')
Usunięte notatki
@endsection
@section('subnav')
    @include('panel.notes.subnav')
@endsection
@section('content')


<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Przedmiot</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Przywracanie</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($notes as $note)
        <tr>
            <th>{{$note->id}}</th>
            <th>
                @if ($note->subject != null)
                    {{$note->subject->name}}
                @else
                    Usunięto
                @endif
            </th>
            <td>{{$note->name}}</td>
            <td>
                <form action="{{route('notes.restore', ['id' => $note->id])}}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success btn-sm"> Przywróć </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col">
        {{$notes->onEachSide(1)->links()}}
    </div>
</div>

@endsection
