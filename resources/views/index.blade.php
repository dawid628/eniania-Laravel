@extends('layouts.app')
@isset($error)
<p>{{$error}}</p>
@endisset
@section('content')
    <div class="section">
        <h1>Kim jesteś?</h1>
        <div class="group">
            <a class="index-btn" href="/profil">NIANIA</a>
            <a class="index-btn" href="/babysitters">RODZIC</a> 
        </div>
    </div>
@endsection