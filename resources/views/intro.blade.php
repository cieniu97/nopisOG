@extends('layouts.master')

@section('content')
<div class="container-fluid">


    <div class="row">
        <div class="col-sm-12 intro">
           

            <div class="opis-tekst">
                <h1>Portal stworzony dla studenta</h1>

                <hr>

                Każdy student co roku poświęca niezliczoną ilość godzin i kilogramy papieru na zapisywanie
                notatek.
                Zrób krok w stronę przyszłości, podziel się swoimi notatkami i przeglądaj notatki innych
                studentów.
                <br>
                Nie wiesz kiedy masz egzamin, poprawę, trzeci termin, kolokwium, wejściówkę?
                W Nopis.pl wszyskie twoje egazminy są uporządkowane i w jednym miejscu.
            </div>

            <div class="instrukcja">
                <div class="obrazek" style="cursor:pointer;" onclick="window.location='/register'">
                    <div class="obrazek-tekst">
                        1. Zarejestruj się
                    </div>
                    <div class="obrazek-zdj">
                        <img src="/layout/contract.png" alt="">
                    </div>
                </div>
                <div class="obrazek">
                    <div class="obrazek-tekst">
                        2. Wybierz uczelnię
                    </div>
                    <div class="obrazek-zdj">
                        <img src="/layout/university.png" alt="">
                    </div>
                </div>
                <div class="obrazek">
                    <div class="obrazek-tekst">
                        3. Pobieraj i udostępniaj
                    </div>
                    <div class="obrazek-zdj">
                        <img src="/layout/upload.png" alt="">
                    </div>
                </div>
            </div>


            
        </div>
    </div>

</div>
@endsection


    

