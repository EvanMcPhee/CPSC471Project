<div id='leaguelist'>
  <div id='filter'>
  @foreach($allleagues as $league)
    @foreach($teams as $team)
      @foreach($belongstos as $belongsto)
        @if($league->id == $team->leagueid && $belongsto->teamid == $team->id && $belongsto->username == Auth::user()->username)</div>
          <div class="card">
          <div class="card-header">
            <a href="{{ action('LeagueController@show', $league->id) }}">{{ $league->name }}</a>
          </div>
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Activity:
              @foreach($allactivities as $activity)
                @if($activity->id == $league->activityid)
                  {{ $activity->name }}
                @endif
              @endforeach
            </li>
            <li class="list-group-item">City: {{ $league->city }}</li>
            <li class="list-group-item">Admin: {{ $league->admin_username }}</li>
          </ul>
          </div>
          <br>
        @endif
      @endforeach
    @endforeach
  @endforeach
</div>
