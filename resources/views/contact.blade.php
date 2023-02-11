@extends('layouts.app')

@section('content')
@isset($message)
<div class="alert alert-success" role="alert">{{ $message }}</div>
@endisset
@isset($error)
<div class="alert alert-danger" role="alert">{{ $problem }}</div>
@endisset
<div class="section">
    <h1 class="text-center mt-2">Kontakt</h1>
  
    <form class="contact-form" method="POST" action="{{ route('create-report') }}">
    @csrf
    <input name="user_id" value="{{ Auth::id() }}" hidden>
    <div class="mb-3 mt-1">
      <label class="form-label">Nazwa</label>
      <input class="form-control" type="text" value="{{ Auth::user()->name }}" disabled />
    </div>
    <div class="mb-2">
      <label class="form-label">Adres email</label>
      <input class="form-control" type="email" value="{{ Auth::user()->email; }}" disabled/>
    </div>
    <div class="mb-2">
        <label class="form-label">Tytuł</label>
        <input class="form-control" name="title" placeholder="Tytuł wiadomości" />
      </div>
    <div class="mb-2">
      <label class="form-label">Wiadomość</label>
      <textarea class="form-control" name="message" placeholder="Treść wiadomości" style="height: 10rem;"></textarea>
    </div>
    <div class="d-grid">
      <button class="layout-btn mt-1" type="submit">Wyślij</button>
    </div>

  </form>

</div>


@endsection
