<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Team;
use DB;
class GameController extends Controller
{
    public function schedule($leagueid)
    {
      $league = League::findOrFail($leagueid);
      $leagueteams = DB::table('teams')
          ->where('teams.leagueid', '=', $league->id)
          ->get();
      $activity = DB::table('activities')
          ->where('activities.id', '=', $league->activityid)->first();
      return view('game.schedule', compact('league','leagueteams','activity'));
    }
}
