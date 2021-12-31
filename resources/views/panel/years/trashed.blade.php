@extends('layouts.panel')
@section('title')
Usunięte roczniki
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
            <th scope="col">Przywracanie</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($years as $year)
        <tr>
            <th>{{$year->id}}</th>
            <th>
                @if ($year->field != null)
                    {{$year->field->name}}
                @else
                    Usunięto
                @endif
            </th>
            <td>{{$year->name}}</td>
            <td>
                <form action="{{route('years.restore', ['id' => $year->id])}}" method="POST">
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
        {{$years->onEachSide(1)->links()}}
    </div>
</div>

@endsection
