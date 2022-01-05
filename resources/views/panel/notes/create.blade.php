@extends('layouts.panel')
@section('title')
Dodaj notatki
@endsection
@section('subnav')
    @include('panel.notes.subnav')
@endsection
@section('content')

<div class="row mt-2">
    <div class="col-12 col-md-6">
        <h2>Dodaj notatki / materiały</h2>
            <form action="{{route('notes.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input class="form-control" type="text" name="subject_id" value="{{$exam->subject->id}}" hidden readonly>
                <input class="form-control" type="text" name="exam_id" value="{{$exam->id}}" hidden readonly>
                
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{old('name')}}">
                </div>
                
                <div class="form-group">
                    <label for="description"> Opis </label>
                    <textarea class="form-control" name="description" rows="3"> {{old('type')}} </textarea>
                </div>

                <div class="form-group">
                    <label for="formFileMultiple" class="form-label">Wybierz pliki</label>
                    <input class="form-control" type="file" name="files[]" id="formFileMultiple" multiple>
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
