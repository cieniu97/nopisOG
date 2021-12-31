@extends('layouts.panel')
@section('title')
Dodaj kierunek
@endsection
@section('subnav')
    @include('panel.fields.subnav')
@endsection
@section('content')

<div class="row mt-2">
    <div class="col-12 col-md-6">
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
