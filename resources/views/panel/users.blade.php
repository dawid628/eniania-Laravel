@extends('panel.layout')
@section('contento')
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
              @if($user->roles->last()->name != 'admin')
              
                <form method="POST" action="{{ route('delete.user', ['id' => $user->id]) }}">
                    @csrf
                    @method('delete')
                    <div class="row m-1"> 
                      <button type="submit" class="btn btn-danger">Usuń</button>
                    </div> 
                </form>
                @else
                  <div class="alert alert-warning m-0 text-center"><strong>brak akcji</strong></div>
                @endif
                @if($user->roles->last()->name == 'user')
                  @if(Auth::user()->roles->last()->name == 'admin')
                  <div class="row m-1">
                    <a class="layout-btn mt-1" href="/makemoderator/{{ $user->id }}">Nadaj moderatora</a>
                  </div>
                  @endif
                @endif
                @if($user->roles->last()->name == 'moderator')
                  @if(Auth::user()->roles->last()->name == 'admin')
                  <div class="row m-1">
                    <a class="layout-btn mt-1" href="/makeuser/{{ $user->id }}">Zabierz moderatora</a>
                  </div>
                  @endif
                @endif
                @if($user->roles->last()->name != 'admin')
                @if(Auth::user()->roles->last()->name == 'admin')
                  <div class="row m-1">
                    <a class="layout-btn mt-1" href="/makeadmin/{{ $user->id }}">Oddaj administratora</a>
                  </div>
                @endif
                @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $users->links('vendor.pagination.custom') }}
@endsection