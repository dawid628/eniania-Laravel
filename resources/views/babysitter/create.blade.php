@extends('layouts.app')

@section('content')
<div class="container">
    @isset($problem)
        <div class="alert alert-danger" role="alert">{{ $problem }}</div>
    @endisset
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tworzenie profilu niani</div>

                <div class="card-body-auto">
                    <form method="POST" action="{{ route('store-babysitter') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="first_name" class="col-md-4 col-form-label text-md-end">Imię</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" required autofocus>
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="second_name" class="col-md-4 col-form-label text-md-end">Nazwisko</label>
                            <div class="col-md-6">
                                <input id="second_name" class="form-control @error('second_name') is-invalid @enderror" name="second_name" required>
                                @error('second_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-end">Numer telefonu</label>
                            <div class="col-md-6">
                                <input id="phone_number" type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57' maxlength="9" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" required>
                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="city" class="col-md-4 col-form-label text-md-end">Miasto</label>
                            <div class="col-md-6">
                                <input id="city" class="form-control" name="city" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="minimum_age" class="col-md-4 col-form-label text-md-end">Opiekuję się dziećmi w wieku</label>
                            <div class="col-md-2">
                                od<input id="minimum_age" type="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="minimum_age" required>
                                do<input id="maximum_age" type="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="maximum_age" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Cena za godzinę</label>
                            <div class="col-md-2">
                                <input id="price" type="number" onkeypress='return event.charCode >= 48 && event.charCode <= 57' class="form-control" name="price" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="description" class="col-md-4 col-form-label text-md-end">Opis</label>
                            <div class="col-md-6">
                                <textarea id="description" rows="8" class="form-control" name="description" required maxlength="100"></textarea>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label class="col-md-4 col-form-label text-md-end">Dodaj zdjęcie</label>
                            <div class="col-md-6">
                                <input type="file" class="form-control form-control-sm" name="image" accept="image/jpg, image/jpeg, image/png"/>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-dark">
                                    Utwórz profil
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
