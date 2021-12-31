@extends('layouts.panel')
@section('title')
Kierunki
@endsection
@section('subnav')
    @include('panel.fields.subnav')
@endsection
@section('content')

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Uniwersytet</th>
            <th scope="col">Nazwa</th>
            
        </tr>
    </thead>
    <tbody>

        @foreach ($fields as $field)
        
            <tr>
                <td> <a href="{{route('fields.show', ['field' => $field->id])}}">{{$field->id}}</a></td>
                <td>
                    @if ($field->university != null)
                        <a href="{{route('universities.show', ['university' => $field->university_id])}}">{{$field->university->name}}</a>
                    @else
                        Usunięto
                    @endif
                </td>
                <td>{{$field->name}}</td>
                <td class="d-none d-md-table-cell"> <a href="{{route('fields.edit', ['field' => $field->id])}}" class="btn btn-warning btn-sm">Edytuj</a></td>
                <td class="d-none d-md-table-cell"> 
                    <form action="{{route('fields.destroy', ['field' => $field->id])}}" method="POST" class="d-inline">
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
        {{$fields->onEachSide(1)->links()}}
    </div>
</div>

@endsection
