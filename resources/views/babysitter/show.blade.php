@extends('layouts.app')

@section('content')
@isset($message)
<div class="alert alert-success" role="alert">{{ $message }}</div>
@endisset
@isset($error)
<div class="alert alert-danger" role="alert">{{ $error }}</div>
@endisset
    <div class="container">
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
            <div class="col-md-8">
                <div class="lead border px-1 w-50">   
                    <p class="h3 m-0 mb-3">Opis profilu</p>
                    <p class="text-nowrap mb-0"> {!! nl2br($babysitter->description) !!}</p> 
                    @if(Auth::id() != $babysitter->user_id)
                    <br><a href="{{ route('chat', ['id' => $babysitter->user_id]) }}"class="btn btn-dark mt-0">Napisz wiadomosc</a>
                    @endif
                    @if(Auth::id() == $babysitter->user_id)
                    <br><a class="btn btn-dark mt-0" href="/edit/{{ $babysitter->id }}">Edytuj</a>
                    @endif
                </div>
             {{-- div na opinie --}}
                <div class="col float-end mt-0">
                    @isset($average)
        
                    <p class="h1 text-center"> Średnia ocena: {{round($average)}}/5 </p>
               
                    @endisset
                <form class="text-center" method="POST" action="{{ route('send-opinion') }}">
                    @csrf
                    <p class="h2 text-center">Wystaw opinie</p>
                    <span id="1" class="fa fa-lg fa-star m-1" value="1" onclick="fillStars(1)"></span>
                    <span id="2" class="fa fa-lg fa-star m-1" value="2" onclick="fillStars(2)"></span>
                    <span id="3" class="fa fa-lg fa-star m-1" value="3" onclick="fillStars(3)"></span>
                    <span id="4" class="fa fa-lg fa-star m-1" value="4" onclick="fillStars(4)"></span>
                    <span id="5" class="fa fa-lg fa-star m-1" value="5" onclick="fillStars(5)"></span>
                    <input name="babysitter_id" value="{{ $babysitter->id }}" hidden>
                    <input name="stars" id="starInput" hidden required oninvalid="alert('Wybierz ilość przyznanych gwiazdek')"><br>
                    <textarea name="comment" type="text" class="mt-2" value="" cols="25" maxlength=50></textarea><br>
                    <button type="submit" class="btn btn-dark mt-2 mb-2">Wystaw opinie</button>
                </form>
            </div>
            <script type="text/javascript" src="{{ asset('/scripts.js') }}"></script>
            </div>
        </div>
        <div class="mt-5">
            @isset($opinions)
                @foreach($opinions as $opinion)
                    @if($opinion->comment != null)
                        <div class="card mb-3">
                            <div class="card-body">
                                <p class="text-break w-75 ">{{ $opinion->comment }}</p>
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex flex-row align-items-center">
                                        <img src="https://t4.ftcdn.net/jpg/03/32/59/65/360_F_332596535_lAdLhf6KzbW6PWXBWeIFTovTii1drkbT.jpg" alt="avatar" width="25" height="25" />
                                        <p class="small mb-0 ms-2">{{ \App\Models\User::find($opinion->author_id)->name }}</p>
                                    </div>
                                <div class="d-flex flex-row align-items-center">
                                    <p class="small text-muted m-1">{{ $opinion->created_at }}</p>
                                     @if($opinion->author_id == Auth::id() || Auth::user()->hasRole('admin'))
                                        <a href="/opinion-delete/{{ $opinion->id }}"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif  
                @endforeach
                {{ $opinions->links('vendor.pagination.custom') }} 
            @endisset
        </div>
    </div>
@endsection
