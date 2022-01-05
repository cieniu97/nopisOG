<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Panel - @yield('title')</title>

    <style>
        a{
            text-decoration: none;
        }
    </style>
</head>

<body>

    {{-- Navigation top --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="/layout/logo.png" alt="Nopis.pl" width="120" class="img-fluid">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    {{-- Panel --}}
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('panel')) ? 'active' : '' }}" aria-current="page" href="{{route('panel')}}">Panel</a>
                      </li>
                    {{-- Users --}}
                    <li class="nav-item ">
                      <a class="nav-link {{ (request()->is('panel/users*')) ? 'active' : '' }}" aria-current="page" href="{{route('users.index')}}">Użytkownicy</a>
                    </li>
                    {{-- Univeristies --}}
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('panel/universities*')) ? 'active' : '' }}" aria-current="page" href="{{route('universities.index')}}">Uniwersystety</a>
                    </li>
                    {{-- Fields --}}
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('panel/fields*')) ? 'active' : '' }}" aria-current="page" href="{{route('fields.index')}}">Kierunki</a>
                    </li>
                    {{-- Years --}}
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('panel/years*')) ? 'active' : '' }}" aria-current="page" href="{{route('years.index')}}">Roczniki</a>
                    </li>
                    {{-- Subjects --}}
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('panel/subjects*')) ? 'active' : '' }}" aria-current="page" href="{{route('subjects.index')}}">Przedmioty</a>
                    </li>
                    {{-- Exams --}}
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('panel/exams*')) ? 'active' : '' }}" aria-current="page" href="{{route('exams.index')}}">Egazaminy</a>
                    </li>
                    {{-- Notes --}}
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('panel/notes*')) ? 'active' : '' }}" aria-current="page" href="{{route('notes.index')}}">Notatki</a>
                    </li>
                    {{-- Subscriptions --}}
                    <li class="nav-item ">
                        <a class="nav-link {{ (request()->is('panel/subscriptions*')) ? 'active' : '' }}" aria-current="page" href="{{route('subscriptions.index')}}">Subskrybcje</a>
                    </li>

                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Znajdź coś" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Szukaj</button>
                </form>
            </div>
        </div>
    </nav>
    
    

    <div class="container">



        <div class="row min-vh-100">
           
            {{-- Content --}}
            <div class="col-12 col-md-12 pl-5">
                
                
                <h1 class="mt-2">@yield('title')</h1>
                {{-- SUB NAVIGATION --}}
                @yield('subnav')
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Display success mesage if there is one --}}
    @if (session('success'))
        <div id="success-message" style="position:fixed; bottom:20px; left:20px; cursor: pointer;" class="bg-success text-white p-3">
            {{session('success')}}
        </div>
    @endif
    

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="/js/panel.js"></script>
</body>

</html>
