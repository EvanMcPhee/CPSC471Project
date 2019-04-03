@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Create a game in: {{ $league->name }}</h1>

  <form method="POST" action="{{ action('GameController@store') }}">

    {{ csrf_field() }}
    <input type="hidden" name="leagueid" value= {{ $league->id }}>

    <div class="form-group">
      <label for="homeid">Select Home Team:</label>
      <select name='homeid'>

          @foreach($leagueteams as $leagueteam)
            <option value='{{ $leagueteam->id }}'>{{$leagueteam->name}}</option>
          @endforeach

      </select>
    </div>

    <div class="form-group">
      <label for="awayid">Select Away Team:</label>
      <select name='awayid'>

          @foreach($leagueteams as $leagueteam)
            <option value='{{ $leagueteam->id }}'>{{$leagueteam->name}}</option>
          @endforeach

      </select>
    </div>

    <div class="form-group">

      <label for="gamedate">Game date:</label>

      <input type="date" name="gamedate">

    </div>

    <div class ="form-group">
      <button type="submit" class="btn btn-primary">Schedule Game</button>
    </div>
</div>


@endsection
