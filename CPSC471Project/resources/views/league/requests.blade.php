@extends('layouts.app')
@section('content')
<div class='container'>
  <h1>Requests:</h1>

  @foreach($leaguerequests as $leaguerequest)
  <div class="card">
    <div class="card-header">
      <h4>Team: <a href="{{ action('TeamController@show', $leaguerequest->teamid) }}">
        @foreach($teams as $team)
          @if($team->id == $leaguerequest->teamid)
            <a href="{{ action('TeamController@show', $team->id) }}">{{ $team->name }}</a>
          @endif
        @endforeach
      </a> would like to join
        @foreach($leagues as $league)
          @if($league->id == $leaguerequest->leagueid)
            <a href="{{ action('LeagueController@show', $league->id) }}">{{ $league->name }}</a>
          @endif
        @endforeach
      </h4>
    </div>

    <li class="list-group-item">{{ $leaguerequest->content }}</li>

    <li class="list-group-item">
      <form method="POST" action="{{ action('LeagueController@acceptRequest') }}">
        {{ csrf_field() }}
        <input type="hidden" name="requestid" value={{ $leaguerequest->id }}>
        <input type="hidden" name="teamid" value={{ $leaguerequest->teamid }}>
        <input type="hidden" name="leagueid" value={{ $leaguerequest->leagueid }}>
        <div class ="form-group">
          <button type="submit" class="btn btn-primary">Accept Request</button>
        </div>
      </form>
    </li>
  </div>

  @endforeach
</div>

@endsection
