@extends('layouts.master')
@section('title')
{{$note->name}}
@endsection


@section('content')
<div class="container min-vh-100">
    <div class="row">
        <div class="col-12 col-md-6 mt-5 text-white">
            
            <h2 >{{$note->name}}</h2>
            @if (auth()->user()->is_admin)
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
            @endif
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
                
                
                
                <li class="list-group-item"><b>Opis</b> <p>{{$note->description}}</p></li>

                <li class="list-group-item"><b>Pliki</b>
                    <ul>
                        <li><b><a class="text-warning" href="/files/download/note/{{$note->id}}">Pobierz wszystkie</a></b></li>
                        @forelse ($note->files as $file)
                            <li><a href="/files/download/{{$file->id}}">{{$file->name}}</a></li>
                            @empty
                            <li>
                                Te materiały nie posiadają żadnych plików
                            </li>
                        @endforelse
                    </ul>
                </li>
    
            </ul> 
    
            
            

        </div>
    
    </div>
</div>

@endsection

