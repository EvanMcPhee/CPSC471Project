<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Team;
use App\Game;
use DB;
use Carbon\Carbon;


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

    public function store(Request $request)
    {
      $game = new Game();
      $game->homeid = $request->homeid;
      $game->awayid = $request->awayid;
      $game->leagueid = $request->leagueid;
      $game->game_date = $request->gamedate;
      $game->activityid = $request->activityid;

      $game->save();

      return redirect('/leagues/'.$request->leagueid);
    }

    public function index($leagueid)
    {
      $league = League::findOrFail($leagueid);
      $pastleaguegames = DB::table('games')
                ->where('games.leagueid', '=', $leagueid)
                ->where('games.game_date', '<', Carbon::now()->toDateString())
                ->latest('game_date')
                ->get();
      $currentleaguegames = DB::table('games')
                ->where('games.leagueid', '=', $leagueid)
                ->where('games.game_date', '>=', Carbon::now()->toDateString())
                ->oldest('game_date')
                ->get();

      $teams = Team::all();

      return view('game.index', compact('league', 'pastleaguegames', 'currentleaguegames', 'teams'));
    }

    public function show($leagueid, $gameid)
    {
      $league = League::findOrFail($leagueid);
      $game = Game::findOrFail($gameid);
      $hometeam = Team::findOrFail($game->homeid);
      $awayteam = Team::findOrFail($game->awayid);
      $teams = Team::all();
      return view('game.show', compact('league', 'game', 'hometeam', 'awayteam', 'teams'));
    }

    public function declarewinner($leagueid, $gameid)
    {
      $league = League::findOrFail($leagueid);
      $game = Game::findOrFail($gameid);
      $hometeam = Team::findOrFail($game->homeid);
      $awayteam = Team::findOrFail($game->awayid);
      $teams = Team::all();
      return view('game.declarewinner', compact('league', 'game', 'hometeam', 'awayteam', 'teams'));
    }

    public function storeResults(Request $request)
    {
      $game = Game::findOrFail($request->gameid);
      $game->winnerid = $request->winner;
      $game->score = $request->score;

      $game->save();

      return redirect('/leagues/'. $game->leagueid . '/games');
    }
}
