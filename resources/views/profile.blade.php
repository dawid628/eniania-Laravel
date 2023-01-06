@extends('layouts.app')

@section('content')
@isset($message)
<div class="alert alert-success" role="alert">{{ $message }}</div>
@endisset
@isset($error)
<div class="alert alert-danger" role="alert">{{ $problem }}</div>
@endisset
@if(Session::has('message'))
<div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
@endif
<div class="container">
    <h1 class="display-4 m-2 text-center mb-0">Profil użytkownika</h1>
    <div class="card-body p-5">
        <form method="POST" action="{{ route('store-user') }}">
            @csrf
            <label class="col-md-4 col-form-label">ID</label><br>
            <input class="form-control" value="{{ $user->id }}" disabled><br>
            <label class="col-md-4 col-form-label">Nazwa</label><br>
            <input class="form-control" value="{{ $user->name }}" name="name"><br>
            <label class="col-md-4 col-form-label">Email</label><br>
            <input class="form-control" name="email" value="{{ $user->email }}"><br>
            <label class="col-md-4 col-form-label">Data dołączenia</label><br>
            <input class="form-control" value="{{ $user->created_at }}" disabled><br>
            <label class="col-md-4 col-form-label">Data ostatniej zmiany</label><br>
            <input class="form-control" value="{{ $user->updated_at }}" disabled><br>
            <button type="submit" class="btn btn-dark">Zapisz zmiany</button>
        </form>
    </div>
    @if(\App\Models\Babysitter::where('user_id', $user->id)->first() != null)
    <h2 class="display-7 p-5 pt-0 mb-0">Twój profil niani:</h2>
        <table class="table table-bordered m-5 mt-0">
            <thead>
              <tr>
                <th scope="col">Imię</th>
                <th scope="col">Nazwisko</th>
                <th scope="col">Miasto</th>
                <th scope="col">Akcje</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td >{{ \App\Models\Babysitter::where('user_id', $user->id)->value('first_name') }}</td>
                <td>{{ \App\Models\Babysitter::where('user_id', $user->id)->value('second_name') }}</td>
                <td>{{ \App\Models\Babysitter::where('user_id', $user->id)->value('city') }}</td>
                <td>
                  <a class="btn btn-dark m-2" href="/babysitter/{{\App\Models\Babysitter::where('user_id', $user->id)->value('id')}}">Podgląd</a>
                  <a class="btn btn-dark m-2" href="edit/{{\App\Models\Babysitter::where('user_id', $user->id)->value('id')}}">Edytuj</a>
                  <a class="btn btn-dark m-2" href="delete/{{ \App\Models\Babysitter::where('user_id', $user->id)->value('id') }}">Usuń</a>
                </td>
              </tr>
            </tbody>
          </table>
    @else
      <h2 class="display-7 m-4 m-0">Nie masz jeszcze profilu niani. <a class="btn btn-dark" href="/create-babysitter">Stwórz</a></h2>
    @endif
</div>
@endsection