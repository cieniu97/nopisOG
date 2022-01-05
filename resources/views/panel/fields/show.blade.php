@extends('layouts.master')
@section('title')
{{$field->name}}
@endsection
@section('content')

<div class="container min-vh-100">
    <div class="row">
        <div class="col-12 mt-5 d-flex  flex-row align-items-center mb-3 bg-light text-dark p-4">
            <img src="/layout/university.png" alt="Kierunek" class="img-fluid" style="margin-right: 20px; height:40px">
            <div class="d-flex flex-column justify-content-center">
                <h5><a href="{{route('universities.show', ['university' => $field->university->id])}}">{{$field->university->name}}</a></h5>
                <h1 class="">
                    {{$field->name}}
                </h1>
            </div>
            
        </div>

        @if (auth()->user()->is_admin)
            <div class="col-12">
                <div>
                    <a href="{{route('fields.edit', ['field' => $field->id])}}" class="btn btn-warning">Edytuj</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                        Usuń
                    </button>
                </div>
                
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
        @endif
        

    
        
    </div>
    <div class="row mt-5 text-white">
        <div class="col-12 col-lg-8 mb-5 mb-lg-0">
            <h2 class="text-white">Lista roczników</h2>
            <ul class="list-group mt-2">
                @forelse ($years as $year)
                    <li class="list-group-item">
                        <a href="{{route('years.show', ['year' => $year->id])}}">{{$year->name}}</a>
                    </li>
                @empty
                    <li class="list-group-item"> Ten kierunek nie posiada jeszcze przypisanych roczników</li>
                @endforelse
                
            </ul>
            <div class="mt-2">
                {{$years->onEachSide(1)->links()}}
            </div>
            
        </div>

        <div class="col-12 col-lg-4">
            <h2>Dodaj rocznik</h2>
            <form action="{{route('years.store')}}" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="university_id"> Uniwersytet </label>
                    <input class="form-control" type="text" value="{{$field->university->name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="field_id"> Kierunek </label>
                    <input class="form-control" type="text" name="field_id" value="{{$field->id}}" hidden readonly>
                    <input class="form-control" type="text" value="{{$field->name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                    <small  class="form-text text-muted">Zalecana struktura - 2018/2019</small>
    
                </div>
                <div class="form-group">
                    <label for="type"> Typ </label>
                    <input class="form-control" type="text" name="type" value="{{old('type')}}">
                    <small  class="form-text text-muted">Na przykład zaoczne lub dzienne</small>
                </div>
                <button type="submit" class="btn btn-success mt-2"> Dodaj </button>
                
            </form>
        </div>
    </div>
</div>

@endsection