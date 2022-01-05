@extends('layouts.panel')
@section('title')
Dodaj uniwersytet
@endsection
@section('subnav')
    @include('panel.universities.subnav')
@endsection
@section('content')

<div class="row mt-2">
    <div class="col-12 col-md-6">
        <form action="{{route('universities.store')}}" method="POST" class="">
            @csrf
        
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
