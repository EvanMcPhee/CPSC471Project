@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Request To Join: {{ $league->name }}</h1>

  <form method="POST" action="{{ action('LeagueController@storeRequest') }}">

    {{ csrf_field() }}
    <input type="hidden" name="leagueid" value= {{ $league->id }}>

    <div class="form-group">
      <label for="teamid">Select Team:</label>
      <select name='teamid'>

          @foreach($usercaptainteams as $team)
            <option value='{{ $team->id }}'>{{$team->name}}</option>
          @endforeach

      </select>
    </div>

    <label for="activityrules">Leave a Message:</label>
    <textarea class="form-control" name="content" rows="3"></textarea>
    <br>
    <div class ="form-group">
      <button type="submit" class="btn btn-primary">Request To Join</button>
    </div>
</div>


@endsection
