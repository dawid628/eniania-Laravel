@extends('layouts.app')

@section('content')
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
                <form method="POST" action="" class="mt-1">
                  @csrf
                  <button type="submit" class="btn btn-primary">Nadaj uprawnienia</button>
              </form>
                @endif
                @if($user->roles->last()->name == 'moderator')
                <form method="POST" action="" class="mt-1">
                  @csrf
                  <button type="submit" class="btn btn-primary">Zabierz uprawnienia</button>
              </form>
                @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</div>
@endsection
