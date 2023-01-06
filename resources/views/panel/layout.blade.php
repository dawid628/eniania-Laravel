@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
@endif
<div class="container">
<h1 class="text-center">PANEL ADMINISTRATORA</h1>
<div class="text-center">
  <a class="btn btn-light" href="{{route('panel')}}">Użytkownicy</a>
  <a class="btn btn-light" href="{{ route('confirming') }}">Oczekujące</a>
  <a class="btn btn-light" href="{{route('panel-babysitters')}}">Ogłoszenia</a>
  <a class="btn btn-light" href="{{ route('reports') }}">Zgłoszenia</a>
</div>
    @yield('contento')
    </div>
</div>
@endsection
