@extends('layouts.panel')
@section('title')
{{$year->name}}
@endsection
@section('subnav')
    @include('panel.years.subnav')
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-6 mt-5">
        
        <h2>Dane</h2>
        <ul class="list-group mt-2">
            <li class="list-group-item"><b>Kierunek</b>
                <p>
                    @if ($year->field != null)
                        <a href="{{route('fields.show', ['field' => $year->field->id])}}">{{$year->field->name}}</a>
                    @else
                        Usunięto
                    @endif
                </p>
            </li>
            <li class="list-group-item"><b>Nazwa</b> <p>{{$year->name}}</p></li>
            <li class="list-group-item"><b>Typ</b> <p>{{$year->type}}</p></li>

        </ul> 

        <div class="mt-2">
            <a href="{{route('years.edit', ['year' => $year->id])}}" class="btn btn-warning d-inline">Edytuj</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                Usuń
            </button>
            <!-- Modal -->
            <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        Czy na pewno chcesz usunąć rocznik {{$year->name}}?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nie</button>
                    <form action="{{route('years.destroy', ['year' => $year->id])}}" method="POST" class="d-inline">
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
        <h2>Przedmioty</h2>
        <ul class="list-group mt-2">
            @forelse ($subjects as $subject)
                <li class="list-group-item">
                    <a href="{{route('subjects.show', ['subject' => $subject->id])}}">{{$subject->name}}</a>
                </li>
            @empty
                <li class="list-group-item"> Ten rocznik nie posiada jeszcze przypisanych przedmiotów</li>
            @endforelse
            
        </ul>
        <div class="mt-2">
            {{$subjects->onEachSide(1)->links()}}
        </div>
        
    </div>
</div>
@endsection

