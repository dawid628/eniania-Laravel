@extends('layouts.app')

@section('content')
@isset($message)
<div class="alert alert-success" role="alert">{{ $message }}</div>
@endisset
@isset($error)
<div class="alert alert-danger" role="alert">{{ $problem }}</div>
@endisset
<div class="container py-4">
    <h1 class="display-4 text-center">Kontakt</h1>
    <span class="lead">Czy masz jakieś pytania? Nasz zespół udzieli wiadomości pocztą e-mail najszybciej jak to możliwe.</span>
  <form method="POST" action="{{ route('create-report') }}">
    @csrf
    <input name="user_id" value="{{ Auth::id() }}" hidden>
    <div class="mb-3 mt-4">
      <label class="form-label">Nazwa</label>
      <input class="form-control" type="text" value="{{ Auth::user()->name }}" disabled />
    </div>
    <div class="mb-3">
      <label class="form-label">Adres email</label>
      <input class="form-control" type="email" value="{{ Auth::user()->email; }}" disabled/>
    </div>
    <div class="mb-3">
        <label class="form-label">Tytuł</label>
        <input class="form-control" name="title" placeholder="Tytuł wiadomości" />
      </div>
    <div class="mb-3">
      <label class="form-label">Wiadomość</label>
      <textarea class="form-control" name="message" placeholder="Treść wiadomości" style="height: 10rem;"></textarea>
    </div>
    <div class="d-grid">
      <button class="btn btn-dark btn-lg" type="submit">Wyślij</button>
    </div>

  </form>

</div>


@endsection
