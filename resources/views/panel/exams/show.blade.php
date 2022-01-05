@extends('layouts.master')
@section('title')
{{$exam->name}}
@endsection

@section('content')
<div class="container min-vh-100 text-white">
    <div class="row mt-5 pb-5 border-bottom">
        <div class="col-12 ">
            {{-- Model information --}}
            <div class="">
                <h2 >{{$exam->name}}</h2>
                @if (auth()->user()->is_admin)
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
                @endif

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
                    <li class="list-group-item"><b>Data</b> <p class="dateToFormat">{{$exam->date}}</p></li>
                    <li class="list-group-item"><b>Opis</b> <p>{{$exam->description}}</p></li>
        
        
                </ul> 
            </div>
            
            
            
        </div>

    </div>

    <div class="row mt-3">
        <div class="col-12 col-md-6">
            {{-- Childeren/Notes --}}
            
                <h2>Notatki</h2>
                <ul class="list-group mt-2">
                    @if (count($exam->notes) != 0)
                        <a href="/download/exam/{{$exam->id}}" class="text-warning">
                            Pobierz wszystkie
                        </a>
                        
                        @forelse ($notes as $note)
                            <li class="list-group-item">
                                <a href="{{route('notes.show', ['note' => $note->id])}}">{{$note->name}}</a>
                            </li>
                        @empty
                            <li class="list-group-item"> Ten egzamin nie posiada jeszcze przypisanych notatek</li>
                        @endforelse
                    @else
                        <li>Brak</li>
                    @endif
                    
                    
                </ul>
                <div class="mt-2">
                    {{$notes->onEachSide(1)->links()}}
                </div>
            
        </div>

        <div class="col-12 col-md-6">
            <h2>Dodaj notatki / materiały</h2>
            <form action="{{route('notes.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="form-control" type="text" name="subject_id" value="{{$exam->subject->id}}" hidden readonly>
                <input class="form-control" type="text" name="exam_id" value="{{$exam->id}}" hidden readonly>
                
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                </div>
                
                <div class="form-group">
                    <label for="description"> Opis </label>
                    <textarea class="form-control" name="description" rows="3"> {{old('type')}} </textarea>
                </div>

                <div class="form-group">
                    <label for="formFileMultiple" class="form-label">Wybierz pliki</label>
                    <input class="form-control" type="file" name="files[]" id="formFileMultiple" multiple>
                </div>

                <button type="submit" class="btn btn-success mt-2"> Dodaj </button>
                
            </form>
        </div>
    </div>

</div>

@endsection

