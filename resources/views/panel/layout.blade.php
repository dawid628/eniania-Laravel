@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
@endif
<div class="section">
<h1 class="text-center mt-2">Panel administratora</h1>
<div class="text-center">
  <a class="layout-btn" href="{{route('panel')}}">Użytkownicy</a>
  <a class="layout-btn" href="{{ route('confirming') }}">Oczekujące</a>
  <a class="layout-btn" href="{{route('panel-babysitters')}}">Ogłoszenia</a>
  <a class="layout-btn" href="{{ route('reports') }}">Zgłoszenia</a>
</div>
    @yield('contento')
    </div>
</div>
@endsection
