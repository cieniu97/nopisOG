@extends('layouts.panel')
@section('title')
{{$subject->name}}
@endsection
@section('subnav')
    @include('panel.subjects.subnav')
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-4 mt-5">
        
        <h2>Dane</h2>
        <ul class="list-group mt-2">
            <li class="list-group-item"><b>Rocznik</b>
                <p>
                    @if ($subject->year != null)
                        <a href="{{route('years.show', ['year' => $subject->year->id])}}">{{$subject->year->name}}</a>
                    @else
                        Usunięto
                    @endif
                </p>
            </li>
            <li class="list-group-item"><b>Nazwa</b> <p>{{$subject->name}}</p></li>
            <li class="list-group-item"><b>Semestr</b> <p>{{$subject->semester}}</p></li>
            <li class="list-group-item"><b>Wykładowca</b> <p>{{$subject->teacher}}</p></li>

        </ul> 

        <div class="mt-2">
            <a href="{{route('subjects.edit', ['subject' => $subject->id])}}" class="btn btn-warning d-inline">Edytuj</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                Usuń
            </button>
            <!-- Modal -->
            <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        Czy na pewno chcesz usunąć przedmiot {{$subject->name}}?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nie</button>
                    <form action="{{route('subjects.destroy', ['subject' => $subject->id])}}" method="POST" class="d-inline">
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

    <div class="col-12 col-md-4 mt-5">
        <h2>Egzaminy</h2>
        <ul class="list-group mt-2">
            @forelse ($exams as $exam)
                <li class="list-group-item">
                    <a href="{{route('exams.show', ['exam' => $exam->id])}}">{{$exam->name}}</a>
                </li>
            @empty
                <li class="list-group-item"> Ten przedmiot nie posiada jeszcze przypisanych egzaminów</li>
            @endforelse
            
        </ul>
        <div class="mt-2">
            {{$exams->onEachSide(1)->links()}}
        </div>
        
    </div>

    <div class="col-12 col-md-4 mt-5">
        <h2>Notatki</h2>
        <ul class="list-group mt-2">
            @forelse ($notes as $note)
                <li class="list-group-item">
                    <a href="{{route('notes.show', ['note' => $note->id])}}">{{$note->name}}</a>
                </li>
            @empty
                <li class="list-group-item"> Ten przedmiot nie posiada jeszcze przypisanych notatek</li>
            @endforelse
            
        </ul>
        <div class="mt-2">
            {{$exams->onEachSide(1)->links()}}
        </div>
        
    </div>
</div>
@endsection

