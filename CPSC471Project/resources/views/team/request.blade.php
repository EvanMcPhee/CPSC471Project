@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Request To Join: {{ $team->name }}</h1>

  <form method="POST" action="{{ action('TeamController@storeRequest') }}">

    {{ csrf_field() }}
    <input type="hidden" id="custId" name="teamid" value= {{ $team->id }}>
    <label for="activityrules">Leave a Message:</label>
    <textarea class="form-control" name="content" rows="3"></textarea>
    <br>
    <div class ="form-group">
      <button type="submit" class="btn btn-primary">Request To Join</button>
    </div>
</div>


@endsection
