@extends('layouts.app')
@section('content')
<div class="container py-5">
  <div class="row">
    <div class="col-md-12">
      <div class="card" id="chat3" style="border-radius: 15px;">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6 col-lg-5 col-xl-4 mb-4 mb-md-0 overflow-auto">
              <div class="p-3">
                <div id="message-box"style="position: relative; height: 400px">
                  <ul class="list-unstyled mb-0">
                    <li class="p-2 border-bottom">
                      @isset($chats)
                        @foreach($chats as $chat)
                          <a href="{{route('chat', ['id' => $chat])}}" class="d-flex justify-content-between">
                            <div class="d-flex flex-row">
                              <div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                alt="avatar 1" width="60">
                                <span class="badge bg-success badge-dot"></span>
                              </div>
                              <div class="pt-1">
                                 <p class="fw-bold mb-0"> {{ App\Models\User::find($chat)->name }} </p>
                                @if(App\Models\Message::where('from_id', '=', $chat)->latest('created_at')->first())
                                  <p class="small text-muted"> {{ substr(App\Models\Message::where('from_id', '=', $chat)->latest('created_at')->first()->body, 0, 20)}}...</p>
                                @else
                                <p class="small text-muted"> {{ substr(App\Models\Message::where('to_id', '=', $chat)->latest('created_at')->first()->body, 0, 20)}}...</p>
                                @endif
                              </div>
                            </div>
                            <div class="pt-1">
                              @if(App\Models\Message::where('to_id', '=', $chat)->first() || App\Models\Message::where('from_id', '=', $chat)->first())

                                @if(App\Models\Message::where('to_id', '=', $chat)->first() && App\Models\Message::where('from_id', '=', $chat)->first())
                                  @if(App\Models\Message::where('from_id', '=', $chat)->first()->created_at > App\Models\Message::where('to_id', '=', $chat)->first()->created_at)
                                    <p class="small text-muted mb-1">{{ App\Models\Message::where('from_id', '=', $chat)->first()->created_at->format('d.m.Y') }}</p>
                                    @else
                                      <p class="small text-muted mb-1">{{ App\Models\Message::where('to_id', '=', $chat)->first()->created_at->format('d.m.Y') }}</p>    
                                  @endif
                                @endif
                                @if(App\Models\Message::where('from_id', '=', $chat)->first() && !(App\Models\Message::where('to_id', '=', $chat)->first()))
                                  <p class="small text-muted mb-1">{{ App\Models\Message::where('from_id', '=', $chat)->first()->created_at->format('d.m.Y') }}</p>
                                @endif
                                @if(App\Models\Message::where('to_id', '=', $chat)->first() && !(App\Models\Message::where('from_id', '=', $chat)->first()))
                                <p class="small text-muted mb-1">{{ App\Models\Message::where('to_id', '=', $chat)->first()->created_at->format('d.m.Y') }}</p>
                              @endif
                              @endif
                              
                            </div>
                          </a>
                          <hr>
                        @endforeach
                      @endisset
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <form id="send-form" class="col-md-6 col-lg-7 col-xl-8" method="POST" action="{{ route('send-message') }}">
            @csrf
              <div id="message-scroll" class="pt-3 pe-3 anyClass overflow-auto" style="position: relative; height: 400px; bottom:0%;">
              @isset($messages)
                @foreach ($messages as $message)
                  @if($message->to_id == Auth::user()->fresh()->id && $message->from_id == $id)
                      {{-- WIADOMOSC OD 1 --}}
                      <div class="d-flex flex-row justify-content-start">
                       <figure>
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                          alt="avatar 1" style="width: 45px; height: 50%;">
                          <figcaption>{{ App\Models\User::find($message->from_id)->name }}</figcaption>
                        </figure>
                        <div>
                          <p class="small p-2 ms-3 mb-1 rounded-3 text-break" style="background-color: #f5f6f7;">{{ $message->body }}</p>
                          <p class="small ms-3 mb-3 rounded-3 text-muted float-end">{{ $message->created_at }}</p>
                        </div>
                      </div>
                    @endif
                     
                    @if($message->to_id == $id && $message->from_id == Auth::user()->fresh()->id)
                      {{-- WIADOMOSC OD 2 --}}
                      <div class="d-flex flex-row justify-content-end">
                        <div>
                          <p class="small p-2 me-3 mb-1 text-white rounded-3 bg-dark text-break">{{ $message->body }}</p>
                          <p class="small me-3 mb-3 rounded-3 text-muted">{{ $message->created_at }}</p>
                        </div>
                        <figure>
                          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                            alt="avatar 1" style="width: 45px; height: 50%;">
                            <figcaption>{{ App\Models\User::find($message->from_id)->name }}</figcaption>
                          </figure>
                      </div>
                    @endif
                @endforeach
              @endisset
            </div>
            @isset($messages)
            @if(App\Models\Message::where('to_id', '=', $id)->where('from_id', '=', Auth::id())->count() == 0)
              @if(App\Models\Message::where('from_id', '=', $id)->where('to_id', '=', Auth::id())->count() == null)
                @if($id != Auth::id())
                <div class="d-flex flex-row justify-content-center">  
                  Wiadomo???? do u??ytkownika: {{ App\Models\User::find($id)->name }}</p>
                </div>
                @endif
              @endif
            @endif
            @endisset
            <div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">    
              <input ID="msgInput" name="message" type="text" class="form-control form-control-lg" id="exampleFormControlInput2" placeholder="Wpisz wiadomo????" value="">
              <input name="to_id" value="{{ $id }}" hidden>
              @if($id != Auth::user()->fresh()->id)
              <button id="btn" type="submit" class="layout-btn primary"><i class="fa fa-send m-2"></i></button>
              @else
              <a id="btn" onclick="messageMyself()" class="btn btn-primary"><i class="fa fa-send m-2"></i></a>
              @endif
            </div>
            </form>
            <script>
              // SCROLLBAR DEFAULT ON BOTTOM
              window.addEventListener("load", (event) => {
                scrollbarBottom();
              });
          </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
