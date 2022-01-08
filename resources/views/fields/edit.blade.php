@extends('layouts.master')
@section('title')
Edytuj kierunek
@endsection

@section('content')
<div class="container text-white min-vh-100">
    <div class="row">
        <div class="col-12">
            <h1>Edytuj kierunek</h1>
        </div>
        <div class="col-12 col-md-6">
            <form action="{{route('fields.update' , ['field' => $field->id])}}" method="POST" class="">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="university_id"> Id uniwersytetu </label>
                    <input class="form-control" type="text" name="university_id" value="{{$field->university_id}}">
                </div>
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{$field->name}}">
                </div>
                <button type="submit" class="btn btn-warning mt-2"> Edytuj </button>
                
                </form>

        </div>
    </div>
</div>


@endsection
