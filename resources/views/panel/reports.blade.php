@extends('panel.layout')
@section('contento')

@if(count($reports) > 0)
    <table id="panel-table" class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nadawca</th>
            <th scope="col">Tytuł</th>
            <th scope="col">Status</th>
            <th scope="col">AKCJE</th>
          </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
          <tr>
            <th scope="row">{{ $report->id }}</th>
            <td>{{ \App\Models\User::find($report->user_id)->name }}</td>
            <td>{{ $report->title }}</td>
            <td>
              @if( $report->status == 0)
              <p>Oczekujące</p>
              @else
              <p>Zakończono</p>
              @endif
            </td>
            <td>
              <a class="btn btn-dark p-1 mr-1" href="/report/{{ $report->id }}">Podgląd</a>
              @if($report->status != 1)
              <a class="btn btn-dark p-1 mr-1" href="/confirm-report/{{ $report->id }}">Zatwierdź</a>
              @endif
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <div class="alert alert-warning mt-5" role="alert">Brak oczekujących zgłoszeń.</div>
      @endif
      {{ $reports->links() }}
@endsection