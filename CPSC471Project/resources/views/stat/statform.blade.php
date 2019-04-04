@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Add a Game Statistic:</h1>

  <form method="POST" action="{{ action('StatController@store') }}">

    {{ csrf_field() }}
    <input type="hidden" name="gameid" value= {{ $game->id }}>
    <input type="hidden" name="leagueid" value= {{ $league->id }}>

    <div class="form-group">
      <label for="playerusername">Select A Player:</label>
      <select name='playerusername'>

          @foreach($homeplayers as $player)
            <option value='{{ $player->username }}'>{{$player->username}}</option>
          @endforeach
          @foreach($awayplayers as $player)
            <option value='{{ $player->username }}'>{{$player->username}}</option>
          @endforeach

      </select>
    </div>

    <div class="form-group">

      <label for="stattype">Stat Type:</label>

      <input type="text" name="stattype" class="form-control">

      <label for="statvalue">Value:</label>

      <input type="text" name="statvalue" class="form-control">

    </div>

    <div class ="form-group">
      <button type="submit" class="btn btn-primary">Add Statistic</button>
    </div>
</div>


@endsection
