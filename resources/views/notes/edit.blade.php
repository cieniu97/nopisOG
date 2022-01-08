@extends('layouts.master')
@section('title')
Edytuj notatki
@endsection

@section('content')
<div class="container min-vh-100 text-white">
    
    <div class="row">
        <div class="col-12">
            <h1>
                Edytuj notatkę
            </h1>
        </div>
        <div class="col-12 col-md-6">
            <form action="{{route('notes.update' , ['note' => $note->id])}}" method="POST" class="">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="subject_id"> Id przedmiotu </label>
                    <input class="form-control" type="text" name="subject_id" value="{{$note->subject_id}}" hidden readonly>
                    <input class="form-control" type="text"  value="{{$note->subject->name}}" readonly>
                </div>
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{$note->name}}">
    
                </div>
                <div class="form-group">
                    <label for="type"> Opis </label>
                    <textarea class="form-control" name="description" id=""> {{$note->description}}</textarea>
                </div>
                <button type="submit" class="btn btn-warning mt-2"> Edytuj </button>
                
                </form>

        </div>
    </div>
</div>



@endsection
