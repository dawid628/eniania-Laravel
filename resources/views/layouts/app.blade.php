<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>{{ config('app.name', 'E-niania') }}</title>
    <script src="{{ asset('/scripts.js') }}"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <a class="navbar-brand m-3 text-white" href="/">E-niania</a>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav ">
            <a class="nav-item nav-link text-white" href="/babysitters">Nianie</a>
            <a class="nav-item nav-link text-white" href="/contact">Kontakt</a>
            @if(Auth::user())
                @if(Auth::user()->hasRole('admin') || Auth::user()->hasRole('moderator'))
                    <a class="nav-item nav-link text-white" href="/panel">Panel</a>
                @endif
            @endif
          </div>
        </div>
        @if(Auth::user())
        <div class="row m-3 p-1">
            <div class="col-sm">
                <a class="nav-item nav-link text-white" href="/chat/{{ Auth::id() }}">Czat
                </a>
            </div>
            <div class="col-sm">
                <a class="nav-item nav-link text-white" href="/profil">Profil
                </a>
            </div>
            <div class="col-sm">
                <a class="nav-item nav-link text-white" href="/logout">Wyloguj</a>
            </div>
        </div>
        @endif
        @if(!Auth::user())
        <div class="row m-4">
            <div class="col-sm">
                <a class="nav-item nav-link text-white" href="/login">Logowanie</a>
            </div>
            <div class="col-sm">
                <a class="nav-item nav-link text-white" href="/register">Rejestracja</a>
            </div>
        </div>
        @endif
      </nav>
@yield('content')
</body>
</html>