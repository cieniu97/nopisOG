@extends('layouts.master')
@section('title')
  Home
@endsection

@section('content')
  <div class="container text-white min-vh-100 mt-3">
    <div class="row">
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
          <ul class="list-group">
            @forelse ($subjects as $subject)
              <li class="list-group-item">
                <a href="{{route('subjects.show', ['subject' => $subject->id])}}">{{$subject->name}}</a>
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
                <th scope="col">Notatki</th>
                <th scope="col">Pobierz wszystkie</th>
  
  
              </tr>
            </thead>
            <tbody>
              @forelse ($allExams as $exam)
              <tr>
                <th class="dateToFormat">{{$exam->date}}</th>
                <td> 
                  <a href="{{route('subjects.show', ['subject' => $exam->subject->id])}}">{{$exam->subject->name}}</a>
                </td>
                <td>
                  
                  <a href="" data-bs-toggle="modal" data-bs-target="#exam{{$exam->id}}">
                    {{$exam->name}}
                  </a>
                  
                  <!-- Modal -->
                  <div class="modal fade text-dark" id="exam{{$exam->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">{{$exam->name}} - Opis</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          {{$exam->description}}
                        </div>
                        
                      </div>
                    </div>
                  </div>
                
                </td>
                <td>
                  @if (count($exam->notes) != 0)
                      <a href="{{route('examNotes', ['exam' => $exam->id])}}" class="btn btn-outline-primary btn-sm" style="display: inline">Wyświetl</a>
                  @else
                    Brak
                  @endif
                  
                </td>
                <td>
                  @if (count($exam->notes) != 0)
                    
                  <form action="/download/exam/{{$exam->id}}" style="display: inline" method="post">
                    @csrf   
                    <input type="image" src="/layout/download.png" alt="" width="25px" style="cursor: pointer">
                  </form>
  
                  @else
                    Brak
                  @endif
                  
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