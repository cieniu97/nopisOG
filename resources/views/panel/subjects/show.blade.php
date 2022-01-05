@extends('layouts.master')
@section('title')
{{$subject->name}}
@endsection
@section('content')

<div class="container min-vh-100">
    <div class="row">

        {{-- Breadcrumbs + model informations --}}
        <div class="col-12 mt-5 d-flex  flex-row align-items-center mb-3 bg-light text-dark p-4">
            <img src="/layout/university.png" alt="Przedmiot" class="img-fluid" style="margin-right: 20px; height:40px">
            <div class="d-flex flex-column justify-content-center">
                <h5><a href="{{route('universities.show', ['university' => $subject->year->field->university->id])}}">{{$subject->year->field->university->name}}</a></h5>
                <h5><a href="{{route('fields.show', ['field' => $subject->year->field->id])}}">{{$subject->year->field->name}}</a></h5>
                <h5><a href="{{route('years.show', ['year' => $subject->year->id])}}">{{$subject->year->name}}</a></h5>

                <h1 class="">
                    {{$subject->name}}
                </h1>
                <p>Semestr: {{$subject->semester}} <br> Wykładowca: {{$subject->teacher}} </p>
            </div>
        </div>

        {{-- Edit and delete buttons if admin user --}}
        @if (auth()->user()->is_admin)
            <div class="col-12">
                <div>
                    <a href="{{route('subjects.edit', ['subject' => $subject->id])}}" class="btn btn-warning">Edytuj</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                        Usuń
                    </button>
                </div>
                
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
        @endif

        {{-- Subscribe button --}}
        <div class="col-12 mt-3">
            <form action="{{route('subjects.subscribe', ['subject' => $subject->id])}}" method="POST" class="d-inline">
                @csrf
                @if (!$is_subscribed)
                    <button type="submit" class="btn btn-outline-success btn-lg">Subskrybuj</button>
                @else
                    <button type="submit" class="btn btn-outline-success btn-lg active">Subskrybujesz</button>
                @endif
                
            </form>
        </div>

    </div>


    <div class="row mt-5 text-white">

        {{-- Notes --}}
        <div class="col-12 col-lg-6 mb-5 mb-lg-0">
            <h2 class="text-white">Notatki</h2>
            <ul class="list-group mt-2">
                @forelse ($notes as $note)
                    <li class="list-group-item">
                        <a href="{{route('notes.show', ['note' => $note->id])}}">{{$note->name}}</a>
                    </li>
                @empty
                    <li class="list-group-item"> Ten kierunek nie posiada jeszcze notatek ani materiałów</li>
                @endforelse
                
            </ul>
            <div class="mt-2">
                {{$notes->onEachSide(1)->links()}}
            </div>
            
        </div>

        {{-- Exams --}}
        <div class="col-12 col-lg-6 mb-5 mb-lg-0">
            <h2 class="text-white">Egzaminy</h2>
            <ul class="list-group mt-2">
                @forelse ($exams as $exam)
                    <li class="list-group-item @if($exam->date < time()) list-group-item-secondary  @endif">
                        
                        <a href="{{route('exams.show', ['exam' => $exam->id])}}">
                            <p class="dateToFormat" style="display:inline">{{$exam->date}}</p> <b>{{$exam->name}}</b> 
                        </a>
                    </li>
                @empty
                    <li class="list-group-item"> Ten kierunek nie posiada jeszcze notatek ani materiałów</li>
                @endforelse
                
            </ul>
            <div class="mt-2">
                {{$notes->onEachSide(1)->links()}}
            </div>
            
        </div>

        
    </div>
</div>

@endsection