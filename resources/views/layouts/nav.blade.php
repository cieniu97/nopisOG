<nav class="navbar navbar-expand-md navbar-dark mb-5 ">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="/layout/logo.png" alt="Nopis.pl" width="120" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth
        <div class="collapse navbar-collapse" id="navbarSupportedContent">


            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>

                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{auth()->user()->name}}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="userDropdown">

                        <form action="/logout" method="post">

                            <li>
                                @csrf
                                <button class="dropdown-item" type="submit">Wyloguj</button>
                            </li>
                        </form>


                       


                    </ul>
                </li>


                @if (auth()->user()->is_admin)
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="contentMenu" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Przeglądaj
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="contentMenu">

                        {{-- Univeristies --}}
                        <li>
                            <a class="dropdown-item" href="{{route('universities.index')}}">Uniwersytety</a>
                        </li>
                        

                        {{-- Fields --}}
                        <li>
                            <a class="dropdown-item" href="{{route('fields.index')}}">Kierunki</a>
                        </li>

                        {{-- Years --}}
                        <li>
                            <a class="dropdown-item" href="{{route('years.index')}}">Roczniki</a>
                        </li>

                        {{-- Subjects --}}
                        <li>
                            <a class="dropdown-item" href="{{route('subjects.index')}}">Przedmioty</a>
                        </li>
                        
                        


                    </ul>
                </li>

                @endif

                <li class="nav-item">
                    <a href="{{route('create')}}" class="nav-link btn btn-outline-warning">
                        Dodaj cokolwiek
                    </a>
                </li>




            </ul>

            <form class="d-flex" action="{{route('search')}}" method="POST">
                @csrf
                <input class="form-control me-2" type="text" name="search" placeholder="Znajdź coś" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Szukaj</button>
            </form>







        </div>
        @endauth

        @guest
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                {{-- Login --}}
                <li class="nav-item ">
                    <a class="nav-link" aria-current="page" href="{{route('login')}}">Login</a>
                </li>
                {{-- Register --}}
                <li class="nav-item ">
                    <a class="nav-link" aria-current="page" href="{{route('register')}}">Rejestracja</a>
                </li>
            </ul>
        </div>
        @endguest



    </div>
</nav>
