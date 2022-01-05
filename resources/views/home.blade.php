@extends('layouts.master')
@section('title')
  Home
@endsection

@section('content')
  <div class="container text-white min-vh-100 mt-3">
    <div class="row">

      {{-- Subscription list - Years and subjects --}}
      <div class="col-12 col-lg-3">
        @if (count($years)>0)
        <h3>Roczniki</h3>
        <ul class="list-group mb-3">
          @forelse ($years as $year)
          <li class="list-group-item">
            <a href="{{route('years.show', ['year' => $year->id])}}">{{$year->name}}</a>
          </li>
              
          @empty

          @endforelse
        </ul> 
        @endif
        

        @if (count($subjects)>0)
          <h3>Subskrypcje dodatkowe</h3>
          <ul class="list-group mb-3">
            @forelse ($subjects as $subject)
              <li class="list-group-item">
                <a href="{{route('subjects.show', ['subject' => $subject->id])}}">{{$subject->name}}</a>
              </li>
                
            @empty

            @endforelse
          </ul>
        @endif

        @if (count($recentNotes)>0)
          <h3>Ostatnio dodane</h3>
          <ul class="list-group">
            @forelse ($recentNotes as $recentNote)
              <li class="list-group-item">
                <a href="{{route('notes.show', ['note' => $recentNote->id])}}">{{$recentNote->name}}</a>
              </li>
                
            @empty

            @endforelse
          </ul>
        @endif
        
        
      </div>


      <div class="col-12 col-lg-9">
        <h3>Egzaminy</h3>

        <div class="table-responsive">
          <table class="table table-dark table-striped">
            <thead>
              <tr>
                <th scope="col">Data</th>
                <th scope="col">Przedmiot</th>
                <th scope="col">Egzamin</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($allExams as $exam)
              <tr>
                {{-- Date --}}
                <th class="dateToFormat">{{$exam->date}}</th>
               
                {{-- Subject --}}
                <td> 
                  <a href="{{route('subjects.show', ['subject' => $exam->subject->id])}}">{{$exam->subject->name}}</a>
                </td>
                
                {{-- Exam --}}
                <td>
                  <a href="{{route('exams.show', ['exam' => $exam->id])}}">
                    {{$exam->name}}
                  </a>
                </td>

  
              </tr>
                
              @empty
                  
              @endforelse
              
            </tbody>
          </table>
        </div>
        
        
      </div>
    </div>
  </div>
@endsection