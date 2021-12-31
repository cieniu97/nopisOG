@extends('layouts.panel')
@section('title')
Notatki
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
            <th scope="col">Data</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($notes as $note)
        
            <tr>
                <td> <a href="{{route('notes.show', ['note' => $note->id])}}">{{$note->id}}</a></td>
                <td>
                    @if ($note->subject != null)
                        <a href="{{route('subjects.show', ['subject' => $note->subject_id])}}">{{$note->subject->name}}</a>
                    @else
                        Usunięto
                    @endif
                </td>
                <td>{{$note->name}}</td>
                <td class="d-none d-md-table-cell"> <a href="{{route('notes.edit', ['note' => $note->id])}}" class="btn btn-warning btn-sm">Edytuj</a></td>
                <td class="d-none d-md-table-cell"> 
                    <form action="{{route('notes.destroy', ['note' => $note->id])}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
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
