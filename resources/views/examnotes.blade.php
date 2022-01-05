@extends('layouts.master')
@section('title')
  Notatki - {{$exam->name}}
@endsection

@section('content')
  <div class="container text-white min-vh-100 mt-3">
    <div class="row">
      <div class="col-12">
        <h1>Notatki - {{$exam->name}}</h1>
      </div>
      <div class="col-12">
 
       <div class="table-responsive">
        <table class="table table-dark table-striped">
          <thead>
            <tr>
              <th>Naza</th>
              <th>Opis</th>
              <th>Pliki</th>


            </tr>
          </thead>
          <tbody>
            @forelse ($exam->notes as $note)
            <tr>
              
              <td> 
                {{$note->name}}
              </td>
              <td>
                {{$note->description}}
              </td>
              <td>
                <ul>
                  <li><b><a class="text-warning" href="/files/download/note/{{$note->id}}">Pobierz wszystkie</a></b></li>
                  @foreach ($note->files as $file)
                    <li><a href="/files/download/{{$file->id}}">{{$file->name}}</a></li>
                  @endforeach
                </ul>
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