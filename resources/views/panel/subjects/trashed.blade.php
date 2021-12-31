@extends('layouts.panel')
@section('title')
Usunięte przedmioty
@endsection
@section('subnav')
    @include('panel.subjects.subnav')
@endsection
@section('content')


<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Rocznik</th>
            <th scope="col">Nazwa</th>
            <th scope="col">Przywracanie</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($subjects as $subject)
        <tr>
            <th>{{$subject->id}}</th>
            <th>
                @if ($subject->year != null)
                    {{$subject->year->name}}
                @else
                    Usunięto
                @endif
            </th>
            <td>{{$subject->name}}</td>
            <td>
                <form action="{{route('subjects.restore', ['id' => $subject->id])}}" method="POST">
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
        {{$subjects->onEachSide(1)->links()}}
    </div>
</div>

@endsection
