@extends('layouts.master')
@section('title')
Edytuj rocznik
@endsection

@section('content')
<div class="container text-white min-vh-100">
    <div class="row">
        <div class="col-12">
            <h1>
                Edytuj rocznik
            </h1>
        </div>
        <div class="col-12 col-md-6">
            <form action="{{route('years.update' , ['year' => $year->id])}}" method="POST" class="">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="field_id"> Id kierunku </label>
                    <input class="form-control" type="text" name="field_id" value="{{$year->field_id}}">
                </div>
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{$year->name}}">
                    <small  class="form-text text-muted">Zalecana struktura - 2018/2019</small>
    
                </div>
                <div class="form-group">
                    <label for="type"> Typ </label>
                    <input class="form-control" type="text" name="type" value="{{$year->type}}">
                    <small  class="form-text text-muted">Na przykład zaoczne lub dzienne</small>
                </div>
                <button type="submit" class="btn btn-warning mt-2"> Edytuj </button>
                
                </form>
                
                
        </div>
    </div>
</div>


@endsection
