@extends('layouts.master')
@section('title')
{{$exam->name}}
@endsection

@section('content')
<div class="container min-vh-100 text-white">
    <div class="row mt-5">
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



</div>

@endsection

