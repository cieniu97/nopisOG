@extends('layouts.panel')
@section('title')
{{$field->name}}
@endsection
@section('subnav')
    @include('panel.fields.subnav')
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-6 mt-5">
        
        <h2>Dane</h2>
        <ul class="list-group mt-2">
            <li class="list-group-item"><b>Uniwersytet</b>
                <p>
                    @if ($field->university != null)
                        <a href="{{route('universities.show', ['university' => $field->university->id])}}">{{$field->university->name}}</a>
                    @else
                        Usunięto
                    @endif
                </p>
            </li>
            <li class="list-group-item"><b>Nazwa</b> <p>{{$field->name}}</p></li>
        </ul> 

        <div class="mt-2">
            <a href="{{route('fields.edit', ['field' => $field->id])}}" class="btn btn-warning d-inline">Edytuj</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                Usuń
            </button>
            <!-- Modal -->
            <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        Czy na pewno chcesz usunąć kierunek {{$field->name}}?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nie</button>
                    <form action="{{route('fields.destroy', ['field' => $field->id])}}" method="POST" class="d-inline">
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
        <h2>Roczniki</h2>
        <ul class="list-group mt-2">
            @forelse ($years as $year)
                <li class="list-group-item">
                    <a href="{{route('years.show', ['year' => $year->id])}}">{{$year->name}}</a>
                </li>
            @empty
                <li class="list-group-item"> Ten uniwersytet nie posiada jeszcze przypisanych roczników</li>
            @endforelse
            
        </ul>
        <div class="mt-2">
            {{$years->onEachSide(1)->links()}}
        </div>
        
    </div>
</div>
@endsection

