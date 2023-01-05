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
        <div class="row mt-2">
            <form method="POST" action="{{ route('update-babysitters') }}" enctype="multipart/form-data">
                @csrf

                <input name="id" value="{{ $babysitter->id }}" hidden><br>
                <label><strong>Imię:</strong> </label><br>
                <input name="first_name" value="{{ $babysitter->first_name }}" required><br>

                <label><strong>Nazwisko:</strong> </label><br>
                <input name="second_name" value="{{ $babysitter->second_name }}" required><br>

                <label><strong>Numer telefonu:</strong></label><br>
                <input name="phone_number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="9" value=" {{ $babysitter->phone_number }}" required><br>

                <label><strong>Miasto:</strong> </label><br>
                <input name="city" value="{{ $babysitter->city }}" required><br>

                <label><strong>Wiek dziecka:</strong></label><br>
                <div class="col-md-2">
                    od<input name="minimum_age" type="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" 
                    value="{{ $babysitter->minimum_age }}" required>
                    do<input name="maximum_age" type="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" 
                    value="{{ $babysitter->maximum_age }}" required>
                </div>

                <label><strong>Cena za godzinę:</strong></label><br>
                <input name="price" type="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control"  
                value="{{ $babysitter->price }}" required>
                
                <label><strong>Opis:</strong></label>
                <textarea name="description" rows="8" class="form-control" required maxlength="100" required>{!! ($babysitter->description) !!}</textarea>

                <div class="col-sm p-0">
                    <img class="img-thumbnail border-0" src="/images/{{$babysitter->photo_name}}"  width="200" height="200" alt="error" />
                    <input type="file" class="form-control form-control-sm" name="image" accept="image/jpg, image/jpeg, image/png"/>
                </div>

                <button type="submit" class="btn btn-dark mt-3">Zapisz zmiany</button>
            </form>
        </div>
</div>
@endsection
