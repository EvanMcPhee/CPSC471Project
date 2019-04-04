@extends('layouts.app')
@section('content')
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

  <script>
    function yourLeagues()
    {
      var x = document.getElementById('editdiv');
      x.innerHTML = document.getElementById('yourleagues').innerHTML;
      document.getElementById('title').innerHTML = "Your Leagues";
    }

    function cityLeagues()
    {
        var x = document.getElementById('editdiv');
        x.innerHTML = document.getElementById('cityleagues').innerHTML;
        document.getElementById('title').innerHTML = "City Leagues";
    }

    function allLeagues()
    {
      var x = document.getElementById('editdiv');
      x.innerHTML = document.getElementById('allleagues').innerHTML;
      document.getElementById('title').innerHTML = "All Leagues";
    }
  </script>

  <div class='container'>
    <h1 id='title'>All Leagues </h1><br>
    <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="yourLeagues()">
      Your Leagues
    </button>

    <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="cityLeagues()">
      Leagues in Your City
    </button>

    <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="allLeagues()">
      All Leagues
    </button>
    @if(Auth::user()->league_admin_flag == 1)
      <button type="button" class="btn btn-primary" data-toggle="button" onclick="location.href='{{ url('/leagues/requests') }}'">
        View League Requests
      </button>
    @endif
    <button type="button" class="btn btn-primary float-right" data-toggle="button" onclick="location.href='{{ url('/leagues/create') }}'">
      Create League
    </button><br><br>


    <div id=editdiv>
      @include('league/partials/allleagues')
    </div>

    <script id="cityleagues" type="text/html">
      @include('league/partials/cityleagues')
    </script>

    <script id="allleagues" type="text/html">
      @include('league/partials/allleagues')
    </script>

    <script id="yourleagues" type="text/html">
      @include('league/partials/yourleagues')
    </script>


  </div>



@endsection
