@extends('layouts.master')
@section('title')
Usunięte uniwersytety
@endsection

@section('content')
<div class="container">
    <table class="table table-dark table-bordered mt-3">
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
</div>



@endsection
