

<!doctype html>
<html lang="en">
  <head>
  <title>Nopis - @yield('title')</title>
  <link rel="shortcut icon" href="/layout/favicon.ico" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Reenie+Beanie|Sulphur+Point&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amiri:400,700&display=swap&subset=latin-ext" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{url('css/style.css')}}">
  </head>
  <body>
    
    @include('layouts.nav')
    
    @yield('content')
    @include('layouts.footer')

    @if (session('message') || $errors->any())
    <div id="errors-message" style="position:fixed; bottom:20px; left:20px; cursor: pointer;" class="bg-secondary text-white p-3">
      <ul>
      
        {{-- Display message if there is one --}}
        @if (session('message'))
        <li>
            {{session('message')}}
        </li>
        @endif

        {{-- Display errors if any --}}
        @if ($errors->any())   
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        @endif
      </ul>

    </div>

      
    @endif
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    
    <script src="/js/home.js"></script>
  </body>
</html>
