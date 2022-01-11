@extends('layouts.master')
@section('title')
Panel zarządzania
@endsection

@section('content')
<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
</script>
<div class="container">
    
<div class="row">
    

    {{-- Create form --}}
    <div class="col ">

        <form class="row bg-light p-3" id="ultra-add-form" action="/" method="POST" autocomplete="off" onsubmit="validateUltraAddForm(event)">
            @csrf
            <div class="bg-dark text-white p-4 rounded mb-3">
                <h2>Dodawanie</h2>
                <p>Z poziomu tego formularza możesz dodać:
                    <ul>
                        <li>
                            Uniwersytet
                        </li>
                        <li>
                            Kierunek
                        </li>
                        <li>
                            Rocznik
                        </li>
                        <li>
                            Przedmiot
                        </li>
                    </ul>
                    Po uzupełnieniu konkretnego pola, jeśli chcesz dodać spokrewnione dane, naciśnij przycisk <b class="text-primary">Dalej</b> a odblokowują się następne. <br> 
                    Możesz zaprzestać dodawanie w każdym momencie klikając przycisk <b class="text-success">Dodaj</b>. Dodane zostaną tylko wypełnione dane</p>
                @if ($errors->any())
                
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="alert alert-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                
                @endif

                
                <p> {{$message ?? ''}}</p>

                @if (Session::has('added'))
                <div class="alert alert-success">
                    Dodano
                    @foreach (Session::get('added') as $item)
                            {{$item->name}} -> 
                    @endforeach
                </div> 
                
                @endif
                

                
            
            </div>

            {{-- Universities --}}
            <div class="col-12 mt-3">
                <label for="university" class="form-label">Uniwersytet</label>

            </div>
            <div class="col-10">
                <input type="text" class="form-control" id="university-input" name="university" list="university-list" required>
                <datalist id="university-list">
                    @foreach ($universities as $university )
                        <option>{{$university->name}}</option>
                    @endforeach    
                </datalist>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary" id="university-done">Dalej</button>
            </div>

            {{-- Fields --}}
            <div class="col-12 mt-3">
                <label for="field" class="form-label">Kierunek</label>

            </div>
            <div class="col-10">
                <input type="text" class="form-control" id="field-input" name="field" list="field-list"  disabled readonly>
                <datalist id="field-list"></datalist>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary disabled" id="field-done">Dalej</button>
            </div>

            {{-- Years --}}
            <div class="col-10 mt-3">
                <label for="year" class="form-label">Rocznik</label>
                <input type="text" class="form-control" id="year-input" name="year" list="year-list"  disabled readonly>
                <datalist id="year-list"></datalist>
            </div>

            <div class="col-12">
                <label for="type" class="form-label">Typ</label>

            </div>
            <div class="col-10">
                <input type="text" class="form-control" id="year-type-input" name="year-type" list="year-type-list"  disabled readonly>
                <datalist id="year-type-list">
                    @foreach ($yearTypes as $yearType)
                        <option >{{$yearType}}</option>
                    @endforeach
                </datalist>
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-primary disabled" id="year-done">Dalej</button>
            </div>

            {{-- Subject --}}
            <div class="col-10 mt-3">
                <label for="subject" class="form-label">Przedmiot</label>
                <input type="text" class="form-control" id="subject-input" name="subject" list="subject-list"  disabled readonly>
                <datalist id="subject-list"></datalist>
            </div>

            <div class="col-10">
                <label for="semester" class="form-label">Semestr</label>
                <input type="text" class="form-control" id="semester-input" name="semester"  disabled readonly>
            </div>

            <div class="col-10">
                <label for="teacher" class="form-label">Wykładowca</label>
                <input type="text" class="form-control" id="teacher-input" name="teacher"  list="teacher-list" disabled readonly>
                <datalist id="teacher-list">
                    @foreach ($teachers as $teacher)
                        <option >{{$teacher}}</option>
                    @endforeach
                </datalist>
            </div>
            
            <div class="col-10 mt-3">
                <button type="submit" class="btn btn-success w-100">Dodaj</button>
            </div>
            
            
        </form>
    </div>
</div>
</div>






@endsection
