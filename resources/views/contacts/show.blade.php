@extends('layouts.app')

@section('content')
@isset($message)
<div class="alert alert-success" role="alert">{{ $message }}</div>
@endisset
@isset($error)
<div class="alert alert-danger" role="alert">{{ $error }}</div>
@endisset
<div class="container">
  <form method="POST" action="{{ route('sendMail') }}">
    @csrf
        <div class="card shadow-none mt-3 border border-light">
            <div class="card-body">
              <div class="media mb-3">
                <img src="https://t4.ftcdn.net/jpg/03/32/59/65/360_F_332596535_lAdLhf6KzbW6PWXBWeIFTovTii1drkbT.jpg" 
                class="rounded-circle mr-3 mail-img shadow" alt="media image"  width="100" height="100">
                  <div class="media-body">
                     <span class="media-meta float-right">{{ $report->created_at }}</span>
                     <h4 class="text-primary m-0">{{ \App\Models\User::find($report->user_id)->name }}</h4>
                     <small class="text-muted">From : {{ \App\Models\User::find($report->user_id)->email }}</small>
                     <input name="email" value="{{ \App\Models\User::find($report->user_id)->email }}" hidden>
                   </div>
               </div>

               <p><b>{{ $report->title }}...</b></p>
               <p>{!! nl2br($report->message) !!}</p>
               <hr>
               <div class="media mt-3">
                   <div class="media-body">
                      <input name="title" value="{{ $report->title }}" hidden>
                       <textarea class="wysihtml5 form-control" name="answer" rows="9" placeholder="Odpowiedz tutaj..."></textarea>
                   </div>
               </div>
               <div class="text-right">
                   <button type="submit" class="btn btn-dark waves-effect waves-light mt-3"><i class="fa fa-send mr-1"></i>Wyślij</button>
               </div>
           
           </div>
         </div>
        </form>
     </div>       
@endsection
