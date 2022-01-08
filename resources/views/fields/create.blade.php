@extends('layouts.master')
@section('title')
Dodaj kierunek
@endsection

@section('content')
<div class="container text-white min-vh-100">
    <div class="row">
        <div class="col-12">
            <h1>Dodaj kierunek
            </h1>
        </div>
        <div class="col-12 col-md-5">
            <form action="{{route('fields.store')}}" method="POST" class="">
                @csrf
                <div class="form-group">
                    <label for="university_id"> Id uniwersytetu </label>
                    <input class="form-control" type="text" name="university_id" value="{{old('university_id')}}">
                </div>
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                </div>
                <button type="submit" class="btn btn-success mt-2"> Dodaj </button>
                
            </form>
                
        </div>
    </div>
</div>

@endsection
