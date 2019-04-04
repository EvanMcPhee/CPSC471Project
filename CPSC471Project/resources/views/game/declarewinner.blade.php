@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Declare Results For: {{ $hometeam->name }} VS {{ $awayteam->name}}</h1>

  <form method="POST" action="{{ action('GameController@storeResults') }}">

    {{ csrf_field() }}
    <input type="hidden" id="custId" name="gameid" value= {{ $game->id }}>
    <label for="winner">Select Winning Team:</label>
    <select name='winner'>


      <option value='{{ $hometeam->id }}'>{{$hometeam->name}}</option>
      <option value='{{ $awayteam->id }}'>{{$awayteam->name}}</option>


    </select>
    <br>
    <label for="activityrules">Score (Home-Away):</label>
    <input type="text" name="score" class="form-control">

    <br>

    <div class ="form-group">
      <button type="submit" class="btn btn-primary">Declare Results</button>
    </div>
</div>


@endsection
