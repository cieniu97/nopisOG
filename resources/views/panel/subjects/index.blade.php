@extends('layouts.panel')
@section('title')
Przedmioty
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
        </tr>
    </thead>
    <tbody>

        @foreach ($subjects as $subject)
        
            <tr>
                <td> <a href="{{route('subjects.show', ['subject' => $subject->id])}}">{{$subject->id}}</a></td>
                <td>
                    @if ($subject->year != null)
                        <a href="{{route('years.show', ['year' => $subject->year_id])}}">{{$subject->year->name}}</a>
                    @else
                        Usunięto
                    @endif
                </td>
                <td>{{$subject->name}}</td>
                <td class="d-none d-md-table-cell"> <a href="{{route('subjects.edit', ['subject' => $subject->id])}}" class="btn btn-warning btn-sm">Edytuj</a></td>
                <td class="d-none d-md-table-cell"> 
                    <form action="{{route('subjects.destroy', ['subject' => $subject->id])}}" method="POST" class="d-inline">
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
        {{$subjects->onEachSide(1)->links()}}
    </div>
</div>

@endsection
