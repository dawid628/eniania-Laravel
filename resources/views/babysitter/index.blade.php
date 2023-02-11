@extends('layouts.app')

@section('content')
<div class="section">
    @if($babysitters->where('confirmed', 1)->count() == 0)
        <div class="alert alert-warning mt-5" role="alert">Przepraszamy, brak ogłoszeń.</div>
    @endif
    <div class="col float-end m-5">
        <form class="form-group" method="GET" action="{{ route('index-babysitters') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Miasto:</label>
                <select class="form-select" name="city">
                    <option value="" selected disabled hidden>Wybierz miasto</option>
                    @foreach(\App\Models\Babysitter::Select('city')->groupBy('city')->get() as $city)
                        <option value="{{ $city->city }}">{{ ucfirst(trans($city->city)) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-2">
                <label>Cena:</label>
                <div class="row no-gutters flex-lg-nowrap">
                    <div class="col-lg-2">
                        <div class="form-group">
                            <input name="price_min" type="text" class="form-control" placeholder="Od" maxlength="4" onkeypress='return event.charCode >= 48 && 
                            event.charCode <= 57'>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <input name="price_max" type="text" class="form-control" placeholder="Do" maxlength="4" onkeypress='return event.charCode >= 48 && 
                            event.charCode <= 57'>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="form-group mt-2">
                <label>Wiek dziecka:</label>
                            <input name="age" type="text" class="form-control w-50" maxlength="2" onkeypress='return event.charCode >= 48 && 
                            event.charCode <= 57'>
            </div>
            <button type="submit" class="layout-btn mt-2">Szukaj</button>
            <a class="layout-btn mt-2" href="{{ route('index-babysitters') }}">Zresetuj</a>
        </form>
    </div>
    @foreach($babysitters as $babysitter)
    @if($babysitter->confirmed)
    <div class="col-sm m-5">
        <div class="row border w-50 mb-3">
            <!-- Babysitter image -->
            <div class="col-sm p-0">
                <img class="img-thumbnail border-0 p-0" src="images/{{$babysitter->photo_name}}"  width="200" height="200" alt="error" />
            </div>
            <div class="col-sm m-2">
                <label><strong>Imię:</strong> {{ ucfirst(trans($babysitter->first_name)) }}</label><br>
                <label><strong>Nazwisko:</strong> {{ ucfirst(trans($babysitter->second_name)) }}</label><br>
                <label><strong>Miasto:</strong> {{ ucfirst(trans($babysitter->city)) }}</label><br>
                <label><strong>Wiek dziecka:</strong> {{ $babysitter->minimum_age }}-{{ $babysitter->maximum_age }}</label><br>
                <label><strong>Cena za 1h:</strong> {{ $babysitter->price }} PLN</label><br>
                <a class="layout-btn" href="/babysitter/{{$babysitter->id}}">Sprawdź</a>
            </div>
        </div>
    </div>
    @endif
    @endforeach
     {{ $babysitters->links('vendor.pagination.custom') }} 
</div>
@endsection
