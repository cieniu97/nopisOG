@extends('layouts.panel')
@section('title')
{{$exam->name}}
@endsection
@section('subnav')
    @include('panel.exams.subnav')
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-6 mt-5">
        
        <h2>Dane</h2>
        <ul class="list-group mt-2">
            <li class="list-group-item"><b>Przedmiot</b>
                <p>
                    @if ($exam->subject != null)
                        <a href="{{route('subjects.show', ['subject' => $exam->subject->id])}}">{{$exam->subject->name}}</a>
                    @else
                        Usunięto
                    @endif
                </p>
            </li>
            <li class="list-group-item"><b>Nazwa</b> <p>{{$exam->name}}</p></li>
            <li class="list-group-item"><b>Data</b> <p class="dateToFormat">{{$exam->type}}</p></li>
            <li class="list-group-item"><b>Opis</b> <p>{{$exam->description}}</p></li>


        </ul> 

        <div class="mt-2">
            <a href="{{route('exams.edit', ['exam' => $exam->id])}}" class="btn btn-warning d-inline">Edytuj</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                Usuń
            </button>
            <!-- Modal -->
            <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        Czy na pewno chcesz usunąć egzamin {{$exam->name}}?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nie</button>
                    <form action="{{route('exams.destroy', ['exam' => $exam->id])}}" method="POST" class="d-inline">
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

    <div class="col-12 col-md-6 mt-5">
        <h2>Notatki</h2>
        <ul class="list-group mt-2">
            @forelse ($notes as $note)
                <li class="list-group-item">
                    <a href="{{route('notes.show', ['note' => $note->id])}}">{{$note->name}}</a>
                </li>
            @empty
                <li class="list-group-item"> Ten egzamin nie posiada jeszcze przypisanych notatek</li>
            @endforelse
            
        </ul>
        <div class="mt-2">
            {{$notes->onEachSide(1)->links()}}
        </div>
        
    </div>
</div>
@endsection

