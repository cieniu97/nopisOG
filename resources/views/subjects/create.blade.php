@extends('layouts.master')
@section('title')
Dodaj przedmiot
@endsection
@section('content')

<div class="container text-white min-vh-100">
    <div class="row">
        <div class="col-12">
            <h1>Dodaj przedmiot</h1>
        </div>
        <div class="col-12 col-md-6">
            <form action="{{route('subjects.store')}}" method="POST" class="">
                @csrf
                <div class="form-group">
                    <label for="year_id"> Id rocznika </label>
                    <input class="form-control" type="text" name="year_id" value="{{old('year_id')}}">
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
