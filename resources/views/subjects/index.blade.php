@extends('layouts.master')
@section('title')
Przedmioty
@endsection

@section('content')

<div class="container">
    <div class="row">
        @if (auth()->user()->is_admin)
            <div class="col-12">
                <a href="{{route('subjects.create')}}" class="btn btn-light mt-1 mr-md-3"> Dodaj przedmiot </a>
                <a href="{{route('subjects.trashed')}}" class="btn btn-light mt-1 mr-md-3"> Usunięte przedmioty </a>
            </div>
        @endif
        
        <div class="col-12">
            <table class="table table-dark table-bordered mt-3">
                <thead>
                    <tr>
                        <th scope="col">Universytet</th>
                        <th scope="col">Kierunek</th>
                        <th scope="col">Rocznik</th>
                        <th scope="col" class="bg-success">Przedmiot</th>
 
                    </tr>
                </thead>
                <tbody>
            
                    @foreach ($subjects as $subject)

                    <tr>
                        <td> <a href="{{route('universities.show', ['university' => $subject->year->field->university->id])}}">{{$subject->year->field->university->name}}</a></td>
                        <td> <a href="{{route('fields.show', ['field' => $subject->year->field->id])}}">{{$subject->year->field->name}}</a></td>
                        <td> <a href="{{route('years.show', ['year' => $subject->year->id])}}">{{$subject->year->name}}</a></td>
                        <td> <a href="{{route('subjects.show', ['subject' => $subject->id])}}">{{$subject->name}}</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="row">
                <div class="col">
                    {{$subjects->onEachSide(1)->links()}}
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
