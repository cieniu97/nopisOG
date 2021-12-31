@extends('layouts.panel')
@section('title')
{{$note->name}}
@endsection
@section('subnav')
    @include('panel.notes.subnav')
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-6 mt-5">
        
        <h2>Dane</h2>
        <ul class="list-group mt-2">
            <li class="list-group-item"><b>Przedmiot</b>
                <p>
                    @if ($note->subject != null)
                        <a href="{{route('subjects.show', ['subject' => $note->subject->id])}}">{{$note->subject->name}}</a>
                    @else
                        Usunięto
                    @endif
                </p>
            </li>
            <li class="list-group-item"><b>Nazwa</b> <p>{{$note->name}}</p></li>
            <li class="list-group-item"><b>Data</b> <p class="dateToFormat">{{$note->type}}</p></li>
            <li class="list-group-item"><b>Opis</b> <p>{{$note->description}}</p></li>


        </ul> 

        <div class="mt-2">
            <a href="{{route('notes.edit', ['note' => $note->id])}}" class="btn btn-warning d-inline">Edytuj</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                Usuń
            </button>
            <!-- Modal -->
            <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        Czy na pewno chcesz usunąć notatki {{$note->name}}?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nie</button>
                    <form action="{{route('notes.destroy', ['note' => $note->id])}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                    </div>
                </div>
                </div>
            </div>
            
            
        </div>
    </div>

</div>
@endsection

