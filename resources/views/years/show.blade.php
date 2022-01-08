@extends('layouts.master')
@section('title')
{{$year->name}}
@endsection
@section('content')

<div class="container min-vh-100">
    <div class="row">
        <div class="col-12 mt-5 d-flex  flex-row align-items-center mb-3 bg-light text-dark p-4">
            <img src="/layout/university.png" alt="Rocznik" class="img-fluid" style="margin-right: 20px; height:40px">
            <div class="d-flex flex-column justify-content-center">
                <h5><a href="{{route('universities.show', ['university' => $year->field->university->id])}}">{{$year->field->university->name}}</a></h5>
                <h5><a href="{{route('fields.show', ['field' => $year->field->id])}}">{{$year->field->name}}</a></h5>
                <h1 class="">
                    {{$year->name}} - {{$year->type}}
                </h1>
            </div>
            
        </div>

        @if (auth()->user()->is_admin)
            <div class="col-12">
                <div>
                    <a href="{{route('years.edit', ['year' => $year->id])}}" class="btn btn-warning">Edytuj</a>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete">
                        Usuń
                    </button>
                </div>
                
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
        @endif
        <div class="col-12 mt-3">
            <form action="{{route('years.subscribe', ['year' => $year->id])}}" method="POST" class="d-inline">
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
        <div class="col-12 col-lg-8 mb-5 mb-lg-0">
            <h2 class="text-white">Lista przedmiotów</h2>
            <ul class="list-group mt-2">
                @forelse ($year->subjects as $subject)
                    <li class="list-group-item">
                        <a href="{{route('subjects.show', ['subject' => $subject->id])}}">{{$subject->name}}</a>
                    </li>
                @empty
                    <li class="list-group-item"> Ten kierunek nie posiada jeszcze przypisanych przedmiotów</li>
                @endforelse
                
            </ul>
            <div class="mt-2">
                {{$subjects->onEachSide(1)->links()}}
            </div>
            
        </div>

        <div class="col-12 col-lg-4">
            <h2>Dodaj przedmiot</h2>
            <form action="{{route('subjects.store')}}" method="POST" >
                @csrf
                <div class="form-group">
                    <label for="university_id"> Uniwersytet </label>
                    <input class="form-control" type="text" value="{{$year->field->university->name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="field_id"> Kierunek </label>
                    <input class="form-control" type="text" value="{{$year->field->name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="field_id"> Rocznik </label>
                    <input class="form-control" type="text" name="year_id" value="{{$year->id}}" hidden readonly>
                    <input class="form-control" type="text" value="{{$year->name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="semester"> Semestr </label>
                    <input class="form-control" type="text" name="semester" value="{{old('semester')}}">
                </div>
    
                <div class="form-group">
                    <label for="teacher"> Wykładowca </label>
                    <input class="form-control" type="text" name="teacher" value="{{old('teacher')}}">
                </div>
                <button type="submit" class="btn btn-success mt-2"> Dodaj </button>
                
            </form>
        </div>
    </div>
</div>

@endsection