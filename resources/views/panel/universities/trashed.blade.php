@extends('layouts.panel')
@section('title')
Usunięte uniwersytety
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
            <th scope="col">Przywracanie</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($universities as $university)
        <tr>
            <th>{{$university->id}}</th>
            <td>{{$university->name}}</td>
            <td>
                <form action="{{route('universities.restore', ['id' => $university->id])}}" method="POST">
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
        {{$universities->onEachSide(1)->links()}}
    </div>
</div>

@endsection
