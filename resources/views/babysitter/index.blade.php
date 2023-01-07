@extends('layouts.app')

@section('content')
<div class="container">
    @if(\App\Models\Babysitter::where('confirmed', 1)->count() == 0)
        <div class="alert alert-warning mt-5" role="alert">Przepraszamy, brak aktualnych ogłoszeń.</div>
    @endif
    @foreach($babysitters as $babysitter)
    @if($babysitter->confirmed)
    <div class="col">
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
        <div class="row border w-50 mb-3">
            <!-- Babysitter image -->
            <div class="col-sm p-0">
                <img class="img-thumbnail border-0" src="images/{{$babysitter->photo_name}}"  width="200" height="200" alt="error" />
            </div>
            <div class="col-sm m-2">
                <label><strong>Imię:</strong> {{ $babysitter->first_name }}</label><br>
                <label><strong>Nazwisko:</strong> {{ $babysitter->second_name }}</label><br>
                <label><strong>Miasto:</strong> {{ $babysitter->city }}</label><br>
                <label><strong>Wiek dziecka:</strong> {{ $babysitter->minimum_age }}-{{ $babysitter->maximum_age }} lata</label><br>
                <label><strong>Cena za 1h:</strong> {{ $babysitter->price }} PLN</label><br>
                <a class="btn btn-dark m-2" href="/babysitter/{{$babysitter->id}}">Sprawdź</a>
            </div>
        </div>
        
    </div>
    @endif
    @endforeach
    {{ $babysitters->links() }}
</div>

@endsection
