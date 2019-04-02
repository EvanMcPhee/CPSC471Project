@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>{{ $team->name }}</h2>
    @if($team->leagueid != null)
      <h4>Competes In: <a href="{{ action('LeagueController@show', $teamsleague->id) }}">{{ $teamsleague->name }}</a></h4>
    @endif

    <h4>Captain: <a href="{{ action('UserController@show', $captain->id) }}">{{ $captain->username }}</a></h4></h4>

    <?php $flag = 0 ?>
    @foreach($belongstos as $belongsto)
      @if($belongsto->username == Auth::user()->username && $belongsto->teamid == $team->id)
        <?php $flag = 1 ?>
      @endif
    @endforeach

    @if($flag == 0)
      <a href="{{ action('TeamController@request', $team->id) }}" class="btn btn-primary"> Request To Join Team </a>
    @endif

    <h4>Roster: </h4>

    <div class="list-group">
      @foreach($teammembers as $teammember)
          <a href="{{ action('UserController@show', $teammember->id) }}" class="list-group-item list-group-item-action list-group-item-primary">{{ $teammember->username }}</a>
      @endforeach
    </div>
  </div>
@endsection
