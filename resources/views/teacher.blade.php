@extends('layouts.master')
@section('title')
  Home
@endsection

@section('content')
  <div class="container text-white min-vh-100 mt-3">
    <div class="row">
      <div class="col-12">
        <h1>Przedmioty powiązane do {{$teacher}}</h1>
      </div>
      <div class="col-12">
        <ul class="list-group">
          @forelse ($subjects as $subject)
            <li class="list-group-item">
              <a href="{{route('subjects.show', ['subject' => $subject->id])}}">
                {{$subject->name}} - 
                {{$subject->year->name}} - 
                {{$subject->year->field->name}} - 
                {{$subject->year->field->university->name}}
              </a>
            </li>
          @empty
              
          @endforelse
          
          
        </ul>
      </div>
    </div>
  </div>
@endsection