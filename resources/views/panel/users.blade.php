@extends('layouts.app')

@section('content')
@if(Session::has('message'))
<div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
@endif
@if(Session::has('error'))
<div class="alert alert-danger" role="alert">{{Session::get('error')}}</div>
@endif
<div class="container">
<h1 class="text-center">PANEL ADMINISTRATORA</h1>
    <table id="panel-table" class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">NAZWA</th>
            <th scope="col">EMAIL</th>
            <th scope="col">Uprawnienia</th>
            <th scope="col">OSTATNIE ZMIANY</th>
            <th scope="col">AKCJE</th>
          </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
          <tr>
            <th scope="row">{{ $user->id }}</th>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->roles->last()->name }}</td>
            <td>{{ $user->updated_at }}</td>  
            <td>
                <form method="POST" action="{{ route('delete.user', ['id' => $user->id]) }}">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                @if($user->roles->last()->name == 'user')
                  <a class="btn btn-primary mt-1" href="/makemoderator/{{ $user->id }}">Nadaj uprawnienia</a>
                @endif
                @if($user->roles->last()->name == 'moderator')
               
                  <a class="btn btn-primary mt-1" href="/makeuser/{{ $user->id }}">Zabierz uprawnienia</a>
      
                @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
