@extends('layouts.app')

@section('content')
<div class="container">
        {{-- <div class="card h-100">
            <!-- Product image-->
            <img class="card-img-top" src="images/{{$babysitter->photo_name}}"  width="450" height="200" alt="error" />
            <!-- Product details-->
            <div class="card-body p-4">
                <div class="text-center">
                    <!-- Product name-->
                    <h5 class="fw-bolder"><a class="show" href="">{{ $babysitter->first_name }}</a></h5>
                    <!-- Product price-->
                    Cena: {{$babysitter->price}}PLN
                </div>
            </div>
            <!-- Product actions-->
             <form method="POST" action=""> 
                @csrf
                <input name="id" value="{{ $babysitter->id }}" type="hidden"/>
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-dark mt-auto">Odwiedź</button>
                </div>
            </form>
        </div> --}}
        <div class="row mt-5">
            <!-- Babysitter image -->
            <figure class="figure col-sm">
                <img class="figure-img img-fluid rounded" src="/images/{{$babysitter->photo_name}}" width="400" height="400" alt="error" />
                <figcaption>
                    <label><strong>Imię:</strong> {{ $babysitter->first_name }}</label><br>
                    <label><strong>Nazwisko:</strong> {{ $babysitter->second_name }}</label><br>
                    <label><strong>Numer telefonu:</strong> {{ $babysitter->phone_number }}</label><br>
                    <label><strong>Adres e-mail:</strong> {{ \App\Models\User::find($babysitter->user_id)->email }}</label><br>
                    <label><strong>Miasto:</strong> {{ $babysitter->city }}</label><br>
                    <label><strong>Wiek dziecka:</strong> {{ $babysitter->minimum_age }}-{{ $babysitter->maximum_age }} lata</label><br>
                    <label><strong>Cena za 1h:</strong> {{ $babysitter->price }} PLN</label><br>
                </figcaption>
            </figure>
            <div class="col-md-8 p-0">
                <p class="lead">
                    {!! nl2br($babysitter->description) !!}
                    @if(Auth::id() != $babysitter->user_id)
                    <br><button class="btn btn-dark mt-3">Napisz wiadomosc</button>
                    @endif
                    @if(Auth::id() == $babysitter->user_id)
                    <br><button class="btn btn-dark mt-3">Edytuj</button>
                    @endif
                </p>
            </div>
            {{-- <div class="col">
                <label><strong>Imię:</strong> {{ $babysitter->first_name }}</label><br>
                <label><strong>Nazwisko:</strong> {{ $babysitter->second_name }}</label><br>
                <label><strong>Miasto:</strong> {{ $babysitter->city }}</label><br>
                <label><strong>Wiek dziecka:</strong> {{ $babysitter->minimum_age }}-{{ $babysitter->maximum_age }} lata</label><br>
                <label><strong>Cena za 1h:</strong> {{ $babysitter->price }} PLN</label><br>
                <button type="submit" class="btn btn-primary m-2">
                    Sprawdź
                </button>
            </div> --}}
        </div>
</div>
@endsection
