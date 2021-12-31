@extends('layouts.panel')
@section('title')
Egzaminy
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
            <th scope="col">Data</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($exams as $exam)
        
            <tr>
                <td> <a href="{{route('exams.show', ['exam' => $exam->id])}}">{{$exam->id}}</a></td>
                <td>
                    @if ($exam->subject != null)
                        <a href="{{route('subjects.show', ['subject' => $exam->subject_id])}}">{{$exam->subject->name}}</a>
                    @else
                        Usunięto
                    @endif
                </td>
                <td>{{$exam->name}}</td>
                <td class="dateToFormat">{{$exam->date}}</td>
                <td class="d-none d-md-table-cell"> <a href="{{route('exams.edit', ['exam' => $exam->id])}}" class="btn btn-warning btn-sm">Edytuj</a></td>
                <td class="d-none d-md-table-cell"> 
                    <form action="{{route('exams.destroy', ['exam' => $exam->id])}}" method="POST" class="d-inline">
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
        {{$exams->onEachSide(1)->links()}}
    </div>
</div>

@endsection
