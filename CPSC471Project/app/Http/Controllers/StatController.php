<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Activity;
use App\Team;
use App\RequestsToJoinLeague;
use App\BelongsTo;
use App\Game;
use Auth;
use DB;
class StatController extends Controller
{
    //
    public function statForm($leagueid, $gameid)
    {

      $league = League::findOrFail($leagueid);
      $game = Game::findOrFail($gameid);
      $hometeam = Team::findOrFail($game->homeid);
      $awayteam = Team::findOrFail($game->awayid);
      $homeplayers = DB::table('users')
          ->join('belongs_tos', 'users.username', '=', 'belongs_tos.username')
          ->join('teams', 'teams.id', '=', 'belongs_tos.teamid')
          ->where('teams.id', '=', $hometeam->id)
          ->select('users.*')
          ->get();

      $awayplayers = DB::table('users')
          ->join('belongs_tos', 'users.username', '=', 'belongs_tos.username')
          ->join('teams', 'teams.id', '=', 'belongs_tos.teamid')
          ->where('teams.id', '=', $awayteam->id)
          ->select('users.*')
          ->get();

      $teams = Team::all();
      return view('stat.statform', compact('league', 'game', 'hometeam', 'awayteam', 'teams', 'awayplayers', 'homeplayers'));
    }
}
