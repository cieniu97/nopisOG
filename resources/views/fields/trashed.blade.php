@extends('layouts.master')
@section('title')
Usunięte kierunki
@endsection
@section('content')

<div class="container">
    <table class="table table-dark table-bordered mt-3">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Uniwersytet</th>
                <th scope="col">Nazwa</th>
                <th scope="col">Przywracanie</th>
            </tr>
        </thead>
        <tbody>
    
            @foreach ($fields as $field)
            <tr>
                <th>{{$field->id}}</th>
                <th>
                    @if ($field->university != null)
                        {{$field->university->name}}
                    @else
                        Usunięto
                    @endif
                </th>
                <td>{{$field->name}}</td>
                <td>
                    <form action="{{route('fields.restore', ['id' => $field->id])}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-sm"> Przywróć </button>
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
</div>


@endsection
