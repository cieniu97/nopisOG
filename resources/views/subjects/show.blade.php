@extends('layouts.master')
@section('title')
{{$subject->name}}
@endsection
@section('content')

<div class="container min-vh-100 ">
    <div class="row mb-3">

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

    {{-- Notes --}}
    <div class="row mb-5">
        
        {{-- Tittle --}}
        <div class="col-12">
            <h2 class="text-white border-bottom pb-3">Notatki</h2>
        </div>

        {{-- List --}}
        <div class="col-12 col-lg-6 mb-5 mb-lg-0">
            <ul class="list-group mt-2">
                @forelse ($notes as $note)
                    <li class="list-group-item">
                        <a href="{{route('notes.show', ['note' => $note->id])}}">{{$note->name}}</a>
                        <a class="text-warning" href="/files/download/note/{{$note->id}}">
                            <img src="/layout/download.png" alt="Pobierz" height="20px">
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

        {{-- Create form --}}
        <div class="col-12 col-lg-6">
            <h5 class="border border-warning  p-2">Dodaj notatki / materiały</h5>
            <form action="{{route('notes.store')}}" method="POST" enctype="multipart/form-data" class="px-4">
                @csrf
                <input class="form-control" type="text" name="subject_id" value="{{$subject->id}}" hidden readonly>
                
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                </div>
                
                <div class="form-group">
                    <label for="description"> Opis </label>
                    <textarea class="form-control" name="description" rows="3"> {{old('description')}} </textarea>
                </div>

                <div class="form-group">
                    <label for="formFileMultiple" class="form-label">Wybierz pliki</label>
                    <input class="form-control" type="file" name="files[]" id="formFileMultiple" multiple>
                </div>

                <button type="submit" class="btn btn-success mt-2"> Dodaj </button>
                
            </form>
        </div>

        
    </div>

    {{-- Exams --}}
    <div class="row text-white">

        {{-- Tittle --}}
        <div class="col-12 ">
            <h2 class="text-white border-bottom pb-3">Egzaminy</h2>
        </div>

        {{-- List --}}
        <div class="col-12 col-lg-6 mb-5 mb-lg-0">
            
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
            
            
        </div>

        {{-- Create form --}}
        <div class="col-12 col-lg-6 mb-5 mb-lg-0">
            <h5 class=" border border-warning  p-2">Dodaj egzamin</h5>
            <form action="{{route('exams.store')}}" method="POST" class="px-4">
                @csrf
                
                <input class="form-control" type="text" name="subject_id" value="{{$subject->id}}" hidden readonly>
                
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
    
                </div>
                <div class="form-group">
                    <label for="date"> Data </label>
                    <input class="form-control" type="datetime-local" name="date" value="{{old('type')}}">
                </div>
                <div class="form-group">
                    <label for="description"> Opis </label>
                    <textarea class="form-control" name="description" rows="3"> {{old('type')}} </textarea>
                </div>
                <button type="submit" class="btn btn-success mt-2"> Dodaj </button>
                
            </form>
        </div>

        
    </div>
</div>

@endsection