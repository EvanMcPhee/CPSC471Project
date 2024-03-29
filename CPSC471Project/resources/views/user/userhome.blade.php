@extends('layouts.app')
@section('content')
<script>



</script>

<div class="container">
<h1>{{$user->username}} <small>, Age: {{$user->age}}, Located: {{$user->province_state}}</small> </h1>
@if(Auth::user()->username != $user->username)
<button type='button' class='btn btn-primary' onclick="location.href='{{url('messagesend',$user->username)}}'"> Send Message </button>
@endif
</br>
</br>
<h1> Teams: </h1>

<div class="list-group">
  @foreach($teams as $team)
  <div class="card">
    <div class="card-header">

        <h3>{{ $team->name }}</h3>

        <button type='button' class='btn btn-primary' onclick="location.href='{{ action('TeamController@show', $team->id) }}'"> Visit Team Homepage </button>
    </div>



      <!--
      <div class='col-md-7'>
      </div>
      <div class='col-md-1'>
        <div class="dropdown">
          <a class='btn btn-secondary dropleft-toggle d-inline-block' href='#' role='button' id='dropdownMenuButton' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Stats
          </a>
          <div class='dropdown-menu' aria-labelledby='dropdownMenuButton'>

          @foreach($teamstats as $stats)
          @if($stats->id == $team->id)
            <a class='dropdown-item' href='#'>{{$stats->stat_type}}:&nbsp {{$stats->value}} </a>
          @endif
          @endforeach
        </div>
        </div>  -->
        @foreach($teamstats as $stat)
          @if($stats->id == $team->id)
          <div class="card-body">

            <h4>{{$stats->stat_type}}:&nbsp {{$stats->value}} </h4>

          </div>
          @endif
        @endforeach
    </div>
  </div>
  <br>
  @endforeach


</div>



</div>
@endsection
<style>
.dd{
  display: inline-block;
}
</style>
