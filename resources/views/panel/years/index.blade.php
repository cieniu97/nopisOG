@extends('layouts.panel')
@section('title')
Roczniki
@endsection
@section('subnav')
    @include('panel.years.subnav')
@endsection
@section('content')

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Kierunek</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Typ</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($years as $year)
        
            <tr>
                <td> <a href="{{route('years.show', ['year' => $year->id])}}">{{$year->id}}</a></td>
                <td>
                    @if ($year->field != null)
                        <a href="{{route('fields.show', ['field' => $year->field_id])}}">{{$year->field->name}}</a>
                    @else
                        Usunięto
                    @endif
                </td>
                <td>{{$year->name}}</td>
                <td>{{$year->type}}</td>
                <td class="d-none d-md-table-cell"> <a href="{{route('years.edit', ['year' => $year->id])}}" class="btn btn-warning btn-sm">Edytuj</a></td>
                <td class="d-none d-md-table-cell"> 
                    <form action="{{route('years.destroy', ['year' => $year->id])}}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Usuń</button>
                    </form>
                </td>

            </tr>
        
        
        @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col">
        {{$years->onEachSide(1)->links()}}
    </div>
</div>

@endsection
