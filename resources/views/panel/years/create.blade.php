@extends('layouts.panel')
@section('title')
Dodaj rocznik
@endsection
@section('subnav')
    @include('panel.years.subnav')
@endsection
@section('content')

<div class="row mt-2">
    <div class="col-12 col-md-6">
        <form action="{{route('years.store')}}" method="POST" class="">
            @csrf
            <div class="form-group">
                <label for="field_id"> Id kierunku </label>
                <input class="form-control" type="text" name="field_id" value="{{old('field_id')}}">
            </div>
            <div class="form-group">
                <label for="name"> Nazwa </label>
                <input class="form-control" type="text" name="name" value="{{old('name')}}">
                <small  class="form-text text-muted">Zalecana struktura - 2018/2019</small>

            </div>
            <div class="form-group">
                <label for="type"> Typ </label>
                <input class="form-control" type="text" name="type" value="{{old('type')}}">
                <small  class="form-text text-muted">Na przykład zaoczne lub dzienne</small>
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
