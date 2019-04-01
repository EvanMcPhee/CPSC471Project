@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="text-center">Create Your Team!</h1>

  <form method="POST" action="{{ action('TeamController@store') }}">

    {{ csrf_field() }}

    <div class="form-group">
      <label for="name">Team Name:</label>
      <input type="text" name="name" class="form-control">
    </div>

    <div class ="form-group">
      <button type="submit" class="btn btn-primary">Create Team</button>
    </div>
</div>


@endsection
