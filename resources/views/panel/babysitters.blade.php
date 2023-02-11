@extends('panel.layout')
@section('contento')
@if(count($babysitters) > 0)
    <table id="panel-table" class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Imię</th>
            <th scope="col">Nazwisko</th>
            <th scope="col">Miasto</th>
            <th scope="col">Data utworzenia</th>
            <th scope="col">AKCJE</th>
          </tr>
        </thead>
        <tbody>
            @foreach($babysitters as $babysitter)
          <tr>
            <th scope="row">{{ $babysitter->id }}</th>
            <td>{{ $babysitter->first_name }}</td>
            <td>{{ $babysitter->second_name }}</td>
            <td>{{ $babysitter->city }}</td>
            <td>{{ $babysitter->created_at }}</td>
            <td>
              <a class="layout-btn p-1 mr-1" href="/babysitter/{{$babysitter->id}}">Podgląd</a>
              @if($babysitter->confirmed == 1)
              <a class="layout-btn p-1 mr-1" href="/unconfirm/{{ $babysitter->id }}">Wyłącz</a>
              @endif
              <a class="layout-btn p-1 mr-1" href="delete/{{ $babysitter->id }}">Usuń</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <div class="alert alert-warning mt-5" role="alert">Brak niań.</div>
      @endif
      {{$babysitters->links('vendor.pagination.custom')}}
@endsection