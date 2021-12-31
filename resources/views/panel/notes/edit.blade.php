@extends('layouts.panel')
@section('title')
Edytuj notatki
@endsection
@section('subnav')
    @include('panel.notes.subnav')
@endsection
@section('content')
<div class="row mt-2">
    <div class="col-12 col-md-6">
        <form action="{{route('notes.update' , ['note' => $note->id])}}" method="POST" class="">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="subject_id"> Id przedmiotu </label>
                <input class="form-control" type="text" name="subject_id" value="{{$note->subject_id}}">
            </div>
            <div class="form-group">
                <label for="name"> Nazwa </label>
                <input class="form-control" type="text" name="name" value="{{$note->name}}">
                <small  class="form-text text-muted">Zalecana struktura - 2018/2019</small>

            </div>
            <div class="form-group">
                <label for="type"> Typ </label>
                <input class="form-control" type="text" name="type" value="{{$note->type}}">
                <small  class="form-text text-muted">Na przykład zaoczne lub dzienne</small>
            </div>
            <button type="submit" class="btn btn-warning mt-2"> Edytuj </button>
            
            </form>
            
            <div>
                @if ($errors->any())
                
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                
                @endif
            </div>
    </div>
</div>

@endsection
