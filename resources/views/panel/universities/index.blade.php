@extends('layouts.panel')
@section('title')
Uniwersytety
@endsection
@section('subnav')
    @include('panel.universities.subnav')
@endsection
@section('content')

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nazwa</th>
            
        </tr>
    </thead>
    <tbody>

        @foreach ($universities as $university)
        <a href="">
            <tr>
                <td> <a href="{{route('universities.show', ['university' => $university->id])}}">{{$university->id}}</a></td>
                <td>{{$university->name}}</td>
                <td class="d-none d-md-table-cell"> <a href="{{route('universities.edit', ['university' => $university->id])}}" class="btn btn-warning btn-sm">Edytuj</a></td>
                <td class="d-none d-md-table-cell"> 
                    <form action="{{route('universities.destroy', ['university' => $university->id])}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                </td>

            </tr>
        </a>
        
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col">
        {{$universities->onEachSide(1)->links()}}
    </div>
</div>

@endsection
