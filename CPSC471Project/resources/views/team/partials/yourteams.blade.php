<div id='teamlist'>
  @foreach($allteams as $team)
    @foreach($belongstos as $belongsto)
      @if($belongsto->username == Auth::user()->username and $belongsto->teamid==$team->id)
        <div class="card">
        <div class="card-header">
          <a href="{{ action('TeamController@show', $team->id) }}">{{ $team->name }}</a>
        </div>
          <li class="list-group-item">Captain: {{ $team->captain_username }}</li>
          @if($team->leagueid != null)
            @foreach($allleagues as $league)
              @if($league->id == $team->leagueid)
                <li class="list-group-item">League: {{ $league->name }}</li>
                @foreach($activities as $activity)
                  @if($league->activityid == $activity->id)
                    <li class="list-group-item">Activity: {{ $activity->name }}</li>
                  @endif
                @endforeach
              @endif
            @endforeach
          @else
            <li class="list-group-item">Not In League </li>
          @endif
        </ul>
        </div>
        <br>
      @endif
    @endforeach
  @endforeach
</div>
