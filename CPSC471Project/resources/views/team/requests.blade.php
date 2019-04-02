@extends('layouts.app')
@section('content')
<div class='container'>
  <h1>Requests:</h1>

  @foreach($teamrequests as $teamrequest)
  <div class="card">
    <div class="card-header">
      <h4>User: <a href="{{ action('UserController@show', $teamrequest->username) }}">{{ $teamrequest->username }}</a> would like to join
        @foreach($teams as $team)
          @if($team->id == $teamrequest->teamid)
            <a href="{{ action('TeamController@show', $team->id) }}">{{ $team->name }}</a>
          @endif
        @endforeach
      </h4>
    </div>

    <li class="list-group-item">{{ $teamrequest->content }}</li>

    <li class="list-group-item">
      <form method="POST" action="{{ action('TeamController@acceptRequest') }}">
        {{ csrf_field() }}
        <input type="hidden" name="requestid" value={{ $teamrequest->id }}>
        <input type="hidden" name="teamid" value={{ $teamrequest->teamid }}>
        <input type="hidden" name="username" value={{ $teamrequest->username }}>
        <div class ="form-group">
          <button type="submit" class="btn btn-primary">Accept Request</button>
        </div>
      </form>
    </li>
  </div>

  @endforeach
</div>

@endsection
