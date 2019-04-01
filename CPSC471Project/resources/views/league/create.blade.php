@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="text-center">Create Your League!</h1>

  <form method="POST" action="{{ action('LeagueController@store') }}">

    {{ csrf_field() }}

    <div class="form-group">
      <label for="name">League Name:</label>
      <input type="text" name="name" class="form-control">
    </div>

    <div class="form-group">
      <label for="city">City:</label>
      <input type="text" name="city" class="form-control">
    </div>

    <div class ="form-group">
      <label for="province_state">Province/State:</label>
      <input type="text" name="province_state" class="form-control">
    </div>

    <div class="form-group">
      <label for="activity">Activity Name:</label>
      <input type="text" name="activity" class="form-control">
    </div>

    <div class="form-group">
      <label for="activitydescription">Activity Description:</label>
      <textarea class="form-control" name="activitydescription" rows="3"></textarea>

    </div>

    <div class="form-group">
      <label for="activityrules">Activity Rules:</label>
      <textarea class="form-control" name="activityrules" rows="3"></textarea>
    </div>

    <div class="form-group">
      <label for="leaguedescription">League Description:</label>
      <textarea class="form-control" name="leaguedescription" rows="3"></textarea>
    </div>


    <div class ="form-group">
      <button type="submit" class="btn btn-primary">Create League</button>
    </div>
</div>


@endsection
