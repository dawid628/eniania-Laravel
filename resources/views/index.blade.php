@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="display-2 m-3 text-center">Kim jesteś?</h1>
        <div class="row text-center">
            <div class="col-sm mt-5" >
                <a class="btn btn-dark btn-lg rounded-circle p-5 m-3 w-50" href="/create-babysitter">NIANIA</a>
                <a class="btn btn-dark btn-lg rounded-circle p-5 m-3 w-50" href="/babysitters">RODZIC</a> 
            </div>
        </div>
    </div>
@endsection
