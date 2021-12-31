@extends('layouts.panel')
@section('title')
Dodaj egzamin
@endsection
@section('subnav')
    @include('panel.exams.subnav')
@endsection
@section('content')

<div class="row mt-2">
    <div class="col-12 col-md-6">
        <form action="{{route('exams.store')}}" method="POST" class="">
            @csrf
            <div class="form-group">
                <label for="subject_id"> Id przedmiotu </label>
                <input class="form-control" type="text" name="subject_id" value="{{old('subject_id')}}">
            </div>
            <div class="form-group">
                <label for="name"> Nazwa </label>
                <input class="form-control" type="text" name="name" value="{{old('name')}}">

            </div>
            <div class="form-group">
                <label for="date"> Data </label>
                <input class="form-control" type="datetime-local" name="date" value="{{old('type')}}">
            </div>
            <div class="form-group">
                <label for="description"> Opis </label>
                <textarea class="form-control" name="description" rows="3"> {{old('type')}} </textarea>
            </div>
            <button type="submit" class="btn btn-success mt-2"> Dodaj </button>
            
        </form>
            
        <div>
            @if ($errors->any())
            
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            
            @endif
        </div>
    </div>
</div>
@endsection
