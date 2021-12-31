@extends('layouts.panel')
@section('title')
Usunięte egzaminy
@endsection
@section('subnav')
    @include('panel.exams.subnav')
@endsection
@section('content')


<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Przedmiot</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Przywracanie</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($exams as $exam)
        <tr>
            <th>{{$exam->id}}</th>
            <th>
                @if ($exam->subject != null)
                    {{$exam->subject->name}}
                @else
                    Usunięto
                @endif
            </th>
            <td>{{$exam->name}}</td>
            <td>
                <form action="{{route('exams.restore', ['id' => $exam->id])}}" method="POST">
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
        {{$exams->onEachSide(1)->links()}}
    </div>
</div>

@endsection
