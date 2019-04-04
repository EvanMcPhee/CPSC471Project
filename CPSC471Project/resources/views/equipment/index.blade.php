@extends('layouts.app')
@section('content')

<div class='container'>

    <h1 id='title'><a href="{{ action('LeagueController@show', $league->id) }}">{{ $league->name }}</a>: Rentable Equipment </h1><br>

    @foreach($equipment as $e)
    <div class="card" >
      <div class="card-header"> <h3> {{ $e->name }} </h3></div>
      <div class="list-group-item"><h3> ${{ $e->price }} </h3></div>
    <div>
    @endforeach

</div>


@endsection
