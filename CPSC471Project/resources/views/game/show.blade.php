@extends('layouts.app')
@section('content')

<div class='container'>
  <h1>League: <a href="{{ action('LeagueController@show', $league->id) }}">{{ $league->name }}</a></h1>
  <h4>
    {{ $hometeam->name }}
    VS
    {{ $awayteam->name }}
  </h4>
  <h4>Date: {{$game->game_date}}</h4>

  @if($game->score != null)
  <h4>Score: {{$game->score }}</h4>
  <h4>Winner:
    @foreach($teams as $team)
      @if($team->id == $game->winnerid)
        <a href="{{ action('TeamController@show', $team->id) }}">{{ $team->name }}</a>
      @endif
    @endforeach
  </h4>
  @elseif(Auth::user()->username == $league->admin_username || Auth::user()->username == $hometeam->captain_username || Auth::user()->username == $awayteam->captain_username)
    <a href="{{ action('GameController@declarewinner', array($league->id, $game->id)) }}" class="btn btn-primary">Submit Winner and Score</a>
  @endif

</div>
@endsection
