@extends('layouts.master')
@section('title')
Roczniki
@endsection

@section('content')

<div class="container">
    <div class="row">
        @if (auth()->user()->is_admin)
            <div class="col-12">
                <a href="{{route('years.create')}}" class="btn btn-light mt-1 mr-md-3"> Dodaj rocznik </a>
                <a href="{{route('years.trashed')}}" class="btn btn-light mt-1 mr-md-3"> Usunięte roczniki </a>
            </div>
        @endif
        
        <div class="col-12">
            <table class="table table-dark table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">Universytet</th>
                        <th scope="col">Kierunek</th>
                        <th scope="col" class="bg-success">Rocznik</th>


                        
                    </tr>
                </thead>
                <tbody>
            
                    @foreach ($years as $year)

                    <tr>
                        <td> <a href="{{route('universities.show', ['university' => $year->field->university->id])}}">{{$year->field->university->name}}</a></td>
                        <td> <a href="{{route('fields.show', ['field' => $year->field->id])}}">{{$year->field->name}}</a></td>
                        <td> <a href="{{route('years.show', ['year' => $year->id])}}">{{$year->name}}</a></td>

                    </tr>
                    
                        
                    

                    
                    @endforeach
                </tbody>
            </table>
            
            <div class="row">
                <div class="col">
                    {{$years->onEachSide(1)->links()}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
