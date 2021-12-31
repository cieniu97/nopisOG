@extends('layouts.panel')
@section('title')
{{$university->name}}
@endsection
@section('subnav')
    @include('panel.universities.subnav')
@endsection

@section('content')

<div class="row">
    <div class="col-12 col-md-6 mt-5">
        
        <h2>Dane</h2>
        <ul class="list-group mt-2">
            <li class="list-group-item"><b>Nazwa</b> <p>{{$university->name}}</p></li>
        </ul> 

        <div class="mt-2">
            <a href="{{route('universities.edit', ['university' => $university->id])}}" class="btn btn-warning d-inline">Edytuj</a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                Usuń
            </button>
            <!-- Modal -->
            <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    
                    <div class="modal-body">
                        Czy na pewno chcesz usunąć egzamin {{$university->name}}?
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Nie</button>
                    <form action="{{route('universities.destroy', ['university' => $university->id])}}" method="POST" class="d-inline">
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
        <h2>Kierunki</h2>
        <ul class="list-group mt-2">
            @forelse ($fields as $field)
                <li class="list-group-item">
                    <a href="{{route('fields.show', ['field' => $field->id])}}">{{$field->name}}</a>
                </li>
            @empty
                <li class="list-group-item"> Ten uniwersytet nie posiada jeszcze przypisanych kierunków</li>
            @endforelse
            
        </ul>
        <div class="mt-2">
            {{$fields->onEachSide(1)->links()}}
        </div>
        
    </div>
</div>

@endsection

