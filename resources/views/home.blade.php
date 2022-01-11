@extends('layouts.master')
@section('title')
Home
@endsection

@section('content')
<div class="container text-white min-vh-100 mt-3">
  
  {{-- Intro for new users --}}
  @if(count($years)==0 && count($subjects)==0)
    <div class="row mb-5 mb-lg-3">
      <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center"><h1>Witaj {{auth()->user()->name}}!</h1></div>
      <div class="col-12 col-lg-5">
        
        <p class="bg-success text-dark p-3 rounded text-white">Jako że jest to najpewniej twój pierwszy raz na tej stronie, pozwól że przedstawimy Ci parę przydatnych informacji, które pomogą Ci w poruszaniu się po stronie</p>
      </div>

      <div class="row">
        <div class="col-1 d-flex align-items-center justify-content-center">
          <b class="text-warning" style="font-size:60px">1</b>
        </div>
        <div class="col-11 col-md-8">
          <h5 class="text-success">Baza informacji</h5>
          <p>
             Nopis.pl posiada bazę danych zawierającą polskie uniwersytety. 
            <a href="{{route('universities.index')}}">Uniwersytety</a> mają przypisane 
            <a href="{{route('fields.index')}}">kierunki</a>, kierunki <a href="{{route('years.index')}}">roczniki</a> a roczniki konkretne <a href="{{route('subjects.index')}}">przedmioty</a>. 
            <br>
            Możesz znaleźć swój rocznik lub poszczególne przedmioty używając paska wyszukiwania w prawym górnym rogu, lub klikając na link przeglądaj w menu głównym.
            <hr>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-1 d-flex align-items-center justify-content-center">
          <b class="text-warning" style="font-size:60px">2</b>
        </div>
        <div class="col-11 col-md-8">
          <h5 class="text-success">Subskrypcje</h5>
          <p>
             
            Główną funkcją serwisu która może Cię zainteresować jest system subskrypcji.
            Ale jak to działa?
            <ul>
              <li>
                Wyszukaj swój rocznik lub konkretny przedmiot
              </li>
              <li>
                Kliknij przycisk subskrybuj
              </li>
              <li>
                To wszystko!
              </li>
              <li>
                Wszyskie bieżące materiały i zbliżające się egzaminy wyświetlą się tutaj
              </li>
            </ul>
            <hr>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-1 d-flex align-items-center justify-content-center">
          <b class="text-warning" style="font-size:60px">3</b>
        </div>
        <div class="col-11 col-md-8">
          <h5 class="text-success">Twój wkład</h5>
          <p>
            Z poziomu podglądu przedmiotu możesz dodać materiały i egzaminy z nim związane.
            Do materiałów możesz załączyć pliki w formatach: jpeg, jpg, doc, docx, odt, pdf, txt <br>
            Jeśli chcesz zamieścić niestandardowe pliki po prostu umieść je w archiwum RAR lub ZIP
          <hr>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-1 d-flex align-items-center justify-content-center">
          <b class="text-warning" style="font-size:60px">4</b>
        </div>
        <div class="col-11 col-md-8">
          <h5 class="text-success">Wyszukiwarka</h5>
          <p>
            W prawym górnym rogu menu znajduje się pasek wyszukiwania. Wpisując całą lub część frazy możesz znaleźć pasujący do niej uniwersytet, kierunek, rocznik lub przedmiot. <br>
            Jednak naszym zdaniem najlepszą funkcją jest wyszukiwanie <b>wykładowców</b>. <br>
            Po znalezieniu wykładowcy możesz zobaczyć wszystkie powiązane przedmioty, <i>daje Ci to możliwość dotarcia do notatek i materiałów z poprzednich lat!</i>
          <hr>
          </p>
        </div>
      </div>

      <div class="row">
        <div class="col-1 d-flex align-items-center justify-content-center">
          <b class="text-warning" style="font-size:60px">5</b>
        </div>
        <div class="col-11 col-md-8">
          <h5 class="text-success">Nie ma tego czego szukasz?</h5>
          <p>
           Jeśli z jakiegoś powodu nie możesz znaleźć swojego przedmiotu, rocznika, kierunku lub uniwersytetu, nie martw się! <br>
           Po prostu <a href="{{route('create')}}" class="btn btn-outline-warning"> Kliknij mnie!</a>
          <hr>
          </p>
        </div>
      </div>
      
    </div>
  @else

  {{-- Dashboard --}}
  <div class="row">

    {{-- Subscription list - Years and subjects --}}
    <div class="col-12 col-lg-3">
        <h3>Roczniki</h3>
        @if (count($years)>0)

        <ul class="list-group mb-3">
            @foreach ($years as $year)
            <li class="list-group-item">
                <a href="{{route('years.show', ['year' => $year->id])}}">{{$year->name}}</a>
            </li>
            @endforeach
        </ul>
        @else
        <div class="border p-3 mb-3">
            W tym miejscu wyświetlać będzie się lista subskrybowanych przez Ciebie roczników. <br>
            Na chwilę obecną nie subskrybujesz żadnego rocznika. 
            <a href="{{route('years.index')}}">Przeglądaj roczniki</a> 
            lub użyj forumalrza wyszukiwania w prawym górnym rogu.
        </div>

        @endif

        <h3>Subskrypcje dodatkowe</h3>
        @if (count($subjects)>0)
        
        <ul class="list-group mb-3">
            @foreach ($subjects as $subject)
            <li class="list-group-item">
                <a href="{{route('subjects.show', ['subject' => $subject->id])}}">{{$subject->name}}</a>
            </li>
            @endforeach
        </ul>
        @else
        <div class="border p-3 mb-3">
          W tym miejscu wyświetlać będzie się lista subskrybowanych przez Ciebie roczników. <br>
          Na chwilę obecną nie subskrybujesz żadnego rocznika. 
          <a href="{{route('years.index')}}">Przeglądaj roczniki</a> 
          lub użyj forumalrza wyszukiwania w prawym górnym rogu.
        </div>
        @endif

        @if (count($recentNotes)>0)
        <h3>Ostatnio dodane materiały</h3>
        <ul class="list-group">
            @forelse ($recentNotes as $recentNote)
            <li class="list-group-item">
                <a href="{{route('notes.show', ['note' => $recentNote->id])}}">{{$recentNote->name}} -
                    {{$recentNote->subject->name}}</a>
            </li>

            @empty

            @endforelse
        </ul>
        @endif


    </div>

    {{-- Exams --}}
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
                            <a
                                href="{{route('subjects.show', ['subject' => $exam->subject->id])}}">{{$exam->subject->name}}</a>
                        </td>

                        {{-- Exam --}}
                        <td>
                            <a href="{{route('exams.show', ['exam' => $exam->id])}}">
                                {{$exam->name}}
                            </a>
                        </td>


                    </tr>

                    @empty
                    <tr>
                      <td>
                        Nie ma zbliżających się egzaminów
                      </td>
                    </tr>
                    @endforelse

                </tbody>
            </table>
        </div>


    </div>

  </div>

  @endif
    
</div>
@endsection
