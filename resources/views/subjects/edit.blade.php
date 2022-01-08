@extends('layouts.master')
@section('title')
    Edytuj przedmiot
@endsection
@section('content')
<div class="container min-vh-100 text-white">
    <div class="row">
        <div class="col-12">
            <h1>
                Edytuj przedmiot
            </h1>
        </div>
        <div class="col-12 col-md-6">
            <form action="{{route('subjects.update' , ['subject' => $subject->id])}}" method="POST" class="">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="year_id"> Id rocznika </label>
                    <input class="form-control" type="text" name="year_id" value="{{$subject->year_id}}">
                </div>
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{$subject->name}}">
                </div>
                <div class="form-group">
                    <label for="semester"> Semestr </label>
                    <input class="form-control" type="text" name="semester" value="{{$subject->semester}}">
                </div>
    
                <div class="form-group">
                    <label for="teacher"> Wykładowca </label>
                    <input class="form-control" type="text" name="teacher" value="{{$subject->teacher}}">
                </div>
                <button type="submit" class="btn btn-warning mt-2"> Edytuj </button>
                
                </form>
                
                
        </div>
    </div>
</div>


@endsection
