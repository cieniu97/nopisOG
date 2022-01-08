@extends('layouts.master')
@section('title')
Edytuj uniwersytet
@endsection
@section('content')

<div class="container text-white min-vh-100">
    
    <div class="row">
        <div class="col-12">
            <h1>Edytuj uniwersytet</h1>
        </div>
        <div class="col-12 col-md-5">
            <form action="{{route('universities.update' , ['university' => $university->id])}}" method="POST" class="">
                @csrf
                @method('PATCH')
            
                <div class="form-group">
                    <label for="name"> Nazwa </label>
                    <input class="form-control" type="text" name="name" value="{{$university->name}}">
                </div>
                <button type="submit" class="btn btn-warning mt-2"> Edytuj </button>
                
                </form>
                

        </div>
    </div>
</div>


@endsection
