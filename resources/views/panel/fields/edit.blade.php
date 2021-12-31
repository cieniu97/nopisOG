@extends('layouts.panel')
@section('title')
Edytuj kierunek
@endsection
@section('subnav')
    @include('panel.fields.subnav')
@endsection
@section('content')
<div class="row mt-2">
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
