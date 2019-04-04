<div id='gamelist'>
  @foreach($currentleaguegames as $game)
      <div class="card">
      <div class="card-header">
        <a href="{{ action('GameController@show', array($league->id, $game->id)) }}">
          @foreach($teams as $team)
            @if($team->id == $game->homeid)
              {{ $team->name }}
            @endif
          @endforeach
          VS
          @foreach($teams as $team)
            @if($team->id == $game->awayid)
                {{ $team->name }}
            @endif
          @endforeach
        </a>
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">
          {{ $game->game_date }}
        </li>
        @if($game->score != null)
            <li class="list-group-item">Score:
              {{ $game->score }}
            </li>
            <li class="list-group-item">Winner:
              @foreach($teams as $team)
                @if($team->id == $game->winnerid)
                  {{ $team->name }}
                @endif
              @endforeach
            </li>
        @endif
      </ul>
      </div>
      <br>
  @endforeach
</div>
