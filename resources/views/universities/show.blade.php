@extends('layouts.master')
@section('title')
{{$university->name}}
@endsection


@section('content')
<div class="container min-vh-100">
    <div class="row">
        <div class="col-12 mt-5 d-flex  flex-row align-items-center mb-3 bg-light text-dark p-4">
            <img src="/layout/university.png" alt="Uniwersytet" class="img-fluid" style="margin-right: 20px; height:40px">
            <div class="d-flex flex-column justify-content-center">
                <h1>
                    {{$university->name}}
                </h1>
            </div>
            
        </div>

        @if (auth()->user()->is_admin)
            <div class="col-12">
                <div>
                    <a href="{{route('universities.edit', ['university' => $university->id])}}" class="btn btn-warning">Edytuj</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                        Usuń
                    </button>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-body">
                            Czy na pewno chcesz usunąć uniwersytet {{$university->name}}?
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
        @endif
        

    
        
    </div>
    <div class="row mt-5 text-white">
        <div class="col-12 col-md-6">
            <h2 class="text-white">Lista kierunków</h2>
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

        <div class="col-12 col-md-6">
            <h2>Dodaj kierunek</h2>
            <form action="{{route('fields.store')}}" method="POST" class="text-white">
                @csrf
                <div class="form-group">
                    <label for="university_id"> Uniwersytet </label>
                    <input class="form-control" type="text" name="university_id" value="{{$university->id}}" hidden readonly>
                    <input class="form-control" type="text" value="{{$university->name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="name"> Nazwa kierunku </label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}" placeholder="Podaj nazwę kierunku">
                </div>
                <button type="submit" class="btn btn-success mt-2"> Dodaj </button>
                
            </form>
        </div>
    </div>
</div>


@endsection

