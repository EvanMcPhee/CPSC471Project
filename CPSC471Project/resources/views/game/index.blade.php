@extends('layouts.app')
@section('content')

<script>
  function upcomingGames()
  {
    var x = document.getElementById('editdiv');
    x.innerHTML = document.getElementById('upcominggames').innerHTML;
    document.getElementById('title').innerHTML = "{{ $league->name }}: Upcoming Games";
  }

  function pastGames()
  {
      var x = document.getElementById('editdiv');
      x.innerHTML = document.getElementById('pastgames').innerHTML;
      document.getElementById('title').innerHTML = "{{ $league->name }}: Past Games";
  }
</script>

<div class='container'>

    <h1 id='title'>{{ $league->name }}: Upcoming Games </h1><br>


    <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="upcomingGames()">
      Upcoming Games
    </button>

    <button type="button" class="btn btn-secondary" data-toggle="button" aria-pressed="false" autocomplete="off" onclick="pastGames()">
      Past Games
    </button>
    <br><br>
    <div id=editdiv>
      @include('game/partials/upcominggames')
    </div>

    <script id="upcominggames" type="text/html">
      @include('game/partials/upcominggames')
    </script>

    <script id="pastgames" type="text/html">
      @include('game/partials/pastgames')
    </script>

</div>


@endsection
