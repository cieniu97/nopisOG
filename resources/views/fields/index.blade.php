@extends('layouts.master')
@section('title')
Kierunki
@endsection

@section('content')

<div class="container">
    <div class="row">
        @if (auth()->user()->is_admin)
            <div class="col-12">
                <a href="{{route('fields.create')}}" class="btn btn-light mt-1 mr-md-3"> Dodaj kierunek </a>
                <a href="{{route('fields.trashed')}}" class="btn btn-light mt-1 mr-md-3"> Usunięte kierunki </a>
            </div>
        @endif
        
        <div class="col-12">
            <table class="table table-dark table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">Universytet</th>
                        <th scope="col" class="bg-success">Kierunek</th>

                        
                    </tr>
                </thead>
                <tbody>
            
                    @foreach ($fields as $field)

                    <tr>
                        <td> <a href="{{route('universities.show', ['university' => $field->university->id])}}">{{$field->university->name}}</a></td>
                        <td> <a href="{{route('fields.show', ['field' => $field->id])}}">{{$field->name}}</a></td>
                    </tr>
                    
                        
                    

                    
                    @endforeach
                </tbody>
            </table>
            
            <div class="row">
                <div class="col">
                    {{$fields->onEachSide(1)->links()}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
