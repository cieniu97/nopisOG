@extends('layouts.master')
@section('title')
Dodaj uniwersytet
@endsection

@section('content')
<div class="container text-white min-vh-100">
    <div class="row">
        <div class="col-12">
            <h1>Dodaj uniwersytet</h1>
        </div>
        <div class="col-12 col-md-5">
            <form action="{{route('universities.store')}}" method="POST" class="">
                @csrf
            
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
