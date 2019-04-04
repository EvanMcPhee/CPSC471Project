@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Add Rentable Equipment:</h1>

  <form method="POST" action="{{ action('EquipmentController@store') }}">

    {{ csrf_field() }}
    <input type="hidden" name="leagueid" value= {{ $league->id }}>

    <div class="form-group">
      <label for="name">Name of Equipment:</label>
      <input type="text" name="name" class="form-control">
    </div>

    <div class="form-group">
      <label for="price">Price to Rent (Must Be a Number):</label>
      <input type="text" name="price" class="form-control">
    </div>


    <div class ="form-group">
      <button type="submit" class="btn btn-primary">Add Equipment</button>
    </div>
</div>


@endsection
