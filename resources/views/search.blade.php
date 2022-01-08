@extends('layouts.master')
@section('title')
  Home
@endsection

@section('content')
  <div class="container text-white min-vh-100 mt-3">
    <div class="row">
      <div class="col-12">
        <h1>Wyniki dla zapytania: {{$search}}</h1>
      </div>
      <div class="col-12">
        <div class="accordion bg-dark" id="matchingResults">
          
          {{-- Matching universities  --}}
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingUniversities">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#matchingUniversities" aria-expanded="true" aria-controls="matchingUniversities">
                Uniwersytety
                <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-danger">
                  {{count($universities)}}
                </span>
              </button>
            </h2>
            <div id="matchingUniversities" class="accordion-collapse collapse" aria-labelledby="headingUniversities" data-bs-parent="#matchingResults">
              <div class="accordion-body">
                <ul class="list-group">
                  @forelse ($universities as $university)
                    <li class="list-group-item">
                      <a href="{{route('universities.show', ['university' => $university->id])}}"><b>{{$university->name}}</b></a>
                    </li>
                  @empty
                    <li class="list-group-item">
                      Nie znalezionego żadnego uniwerystetu.
                      <a href="{{route('create')}}">Dodaj</a>
                    </li>
                  @endforelse
                  
                </ul>
                
              </div>
            </div>
          </div>

          {{-- Matching fields  --}}
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFields">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#matchingFields" aria-expanded="true" aria-controls="matchingFields">
                Kierunki
                <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-danger">
                  {{count($fields)}}
                </span>
              </button>
            </h2>
            <div id="matchingFields" class="accordion-collapse collapse" aria-labelledby="headingFields" data-bs-parent="#matchingResults">
              <div class="accordion-body">
                <ul class="list-group">
                  @forelse ($fields as $field)
                    <li class="list-group-item">
                      <a href="{{route('fields.show', ['field' => $field->id])}}"><b>{{$field->name}}</b> - {{$field->university->name}}</a>
                    </li>
                  @empty
                    <li class="list-group-item">
                      Nie znalezionego żadnego kierunku.
                      <a href="{{route('create')}}">Dodaj</a>
                    </li>
                  @endforelse
                  
                </ul>
                
              </div>
            </div>
          </div>

          {{-- Matching years  --}}
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingYears">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#matchingYears" aria-expanded="true" aria-controls="matchingYears">
                Roczniki
                <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-danger">
                  {{count($years)}}
                </span>
              </button>
            </h2>
            <div id="matchingYears" class="accordion-collapse collapse" aria-labelledby="headingYears" data-bs-parent="#matchingResults">
              <div class="accordion-body">
                <ul class="list-group">
                  @forelse ($years as $year)
                    <li class="list-group-item">
                      <a href="{{route('years.show', ['year' => $year->id])}}"><b>{{$year->name}}</b> - {{$year->field->name}} - {{$year->field->university->name}}</a>
                    </li>
                  @empty
                    <li class="list-group-item">
                      Nie znalezionego żadnego rocznika.
                      <a href="{{route('create')}}">Dodaj</a>
                    </li>
                  @endforelse
                  
                </ul>
                
              </div>
            </div>
          </div>

          {{-- Matching subjects  --}}
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingSubjects">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#matchingSubjects" aria-expanded="true" aria-controls="matchingSubjects">
                Przedmioty
                <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-danger">
                  {{count($subjects)}}
                </span>
              </button>
            </h2>
            <div id="matchingSubjects" class="accordion-collapse collapse" aria-labelledby="headingSubjects" data-bs-parent="#matchingResults">
              <div class="accordion-body">
                <ul class="list-group">
                  @forelse ($subjects as $subject)
                    <li class="list-group-item">
                      <a href="{{route('subjects.show', ['subject' => $subject->id])}}"><b>{{$subject->name}}</b> - {{$subject->year->name}} - {{$subject->year->field->name}} - {{$subject->year->field->university->name}}</a>
                    </li>
                  @empty
                    <li class="list-group-item">
                      Nie znalezionego żadnych przedmiotów.
                      <a href="{{route('create')}}">Dodaj</a>
                    </li>
                  @endforelse
                  
                </ul>
                
              </div>
            </div>
          </div>

          {{-- Matching teachers  --}}
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTeachers">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#matchingTeachers" aria-expanded="true" aria-controls="matchingTeachers">
                Wykładowcy
                <span class="position-absolute top-50 start-0 translate-middle badge rounded-pill bg-danger">
                  {{count($teachers)}}
                </span>
              </button>
            </h2>
            <div id="matchingTeachers" class="accordion-collapse collapse" aria-labelledby="headingTeachers" data-bs-parent="#matchingResults">
              <div class="accordion-body">
                <ul class="list-group">
                  @forelse ($teachers as $teacher)
                    <li class="list-group-item">
                      <a href="/teacher/{{$teacher}}">{{$teacher}}</a>
                    </li>
                  @empty
                    <li class="list-group-item">
                      Nie znalezionego żadnych wykładowców.
                    </li>
                  @endforelse
                  
                </ul>
                
              </div>
            </div>
          </div>

          
        </div>
      </div>
    </div>
  </div>
@endsection