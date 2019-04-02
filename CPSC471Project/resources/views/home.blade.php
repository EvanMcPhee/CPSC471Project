@extends('layouts.app')

@section('content')
<div class="container">

  <h1>Hello {{ Auth::user()->username}}</h1><br>
    <td><button onclick="location.href='{{ url('/leagues') }}'" class="btn btn-primary">View Leagues</button></td>
    <br><br>
    <td><button onclick="location.href='{{ url('/teams') }}'" class="btn btn-primary">View Teams</button></td>


</div>
@endsection
