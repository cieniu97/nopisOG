@extends('layouts.master')
@section('title')
Edytuj egzamin
@endsection
@section('content')
<div class="container min-vh-100 text-white">
    <div class="col-12">
        <h1>
            Edytuj egzamin
        </h1>
    </div>

    <div class="row">
        <div class="col-12 col-md-6">
            <form action="{{route('exams.update' , ['exam' => $exam->id])}}" method="POST" class="">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="subject_id"> Id przedmiotu </label>
                    <input class="form-control" type="text" name="subject_id" value="{{$exam->subject->id}}" hidden>
                    <input class="form-control" type="text"  value="{{$exam->subject->name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{$exam->name}}">
    
                </div>
                <div class="form-group">
                    <label for="date"> Data </label>
                    <input class="form-control dateToFormatInput" type="datetime-local" name="date" value="{{$exam->date}}">
                </div>
                <div class="form-group">
                    <label for="description"> Opis </label>
                    <textarea class="form-control" name="description" rows="3"> {{$exam->description}} </textarea>
                </div>
                <button type="submit" class="btn btn-warning mt-2"> Edytuj </button>
                
                </form>

        </div>
    </div>
</div>



@endsection
