@extends('layouts.app')
@section('content')
  <script>
    function yourLeagues()
    {
      //todo
    }

    function cityLeagues()
    {
      var editdiv = document.getElementById("filter");

    }

    function allLeagues()
    {

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
    </button><br><br>


    @include(allleagues)

  </div>



@endsection
