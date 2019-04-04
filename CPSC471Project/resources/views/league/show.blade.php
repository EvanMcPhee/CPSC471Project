@extends('layouts.app')

@section('content')

  <div class="container">
    <h1>{{ $league->name }}</h2>

    <h4>Admin: <a href="{{ action('UserController@show', $admin->id) }}">{{ $admin->username }}</a></h4></h4>
    <p>{{ $league->description }}</p>

    <?php $flag = 0 ?>
    @foreach($leagueteams as $leagueteam)
      @foreach($userteams as $userteam)
        @if($leagueteam->id == $userteam->id)
          <?php $flag = 1 ?>
        @endif
      @endforeach
    @endforeach

    @if($flag == 0 && Auth::user()->captain_flag == 1)
      <a href="{{ action('LeagueController@request', $league->id) }}" class="btn btn-primary"> Request To Join League </a>
    @endif

    @if(Auth::user()->username == $league->admin_username)
      <a href="{{ action('GameController@schedule', $league->id) }}" class="btn btn-primary"> Schedule a Game </a>
    @endif

      <a href="{{ action('GameController@index', $league->id) }}" class="btn btn-primary"> View Games </a>

    <h4>Teams: </h4>

    <div class="list-group">
      @foreach($sortedleagueteams as $leagueteam)

          <a href="{{ action('TeamController@show', $leagueteam->id) }}" class="list-group-item list-group-item-action list-group-item-primary">{{ $leagueteam->name }}   <p style="float:right">{{$leagueteam->wins}} - {{$leagueteam->losses}}</p></a>
      @endforeach
    </div>
  </div>
@endsection
