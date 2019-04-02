@extends('layouts.app')
@section('content')


  <script>
    function yourTeams()
    {
      var x = document.getElementById('editdiv');
      x.innerHTML = document.getElementById('yourTeams').innerHTML;
      document.getElementById('title').innerHTML = "Your Teams";
    }

    function allTeams()
    {
      var x = document.getElementById('editdiv');
      x.innerHTML = document.getElementById('allTeams').innerHTML;
      document.getElementById('title').innerHTML = "All Teams";
    }
  </script>

  <div class='container'>
    <h1 id='title'>Your Teams</h1><br>
    <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="yourTeams()">
      Your Teams
    </button>

    <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="allTeams()">
      All Teams
    </button>
    <button type="button" class="btn btn-primary float-right" data-toggle="button" onclick="location.href='{{ url('/teams/create') }}'">
      Create Team
    </button>

    @if(Auth::user()->captain_flag == 1)
      <button type="button" class="btn btn-primary" data-toggle="button" onclick="location.href='{{ url('/teams/requests') }}'">
        View Team Requests
      </button>
    @endif
    <br><br>
    <div id=editdiv>
      @include('team/partials/yourteams')
    </div>

    <script id="allTeams" type="text/html">
      @include('team/partials/allteams')
    </script>

    <script id="yourTeams" type="text/html">
      @include('team/partials/yourteams')
    </script>


  </div>

@endsection
