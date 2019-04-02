<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Activity;
use App\Team;
use App\RequestsToJoinLeague;
use App\BelongsTo;
use Auth;
use DB;

class LeagueController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allleagues = League::all();
        $allactivities = Activity::all();
        $user = Auth::user();
        $teams = Team::all();
        $belongstos = BelongsTo::all();

        return view('league.index', compact('allleagues', 'allactivities', 'user', 'teams', 'belongstos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('league.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $league = new League();
        $activity = new Activity();
        $adminusername= Auth::user()->username;
        $user = Auth::user();

        $activity->name = request('activity');
        $activity->description = request('activitydescription');
        $activity->rules = request('activityrules');

        $activity->save();

        $league->city = request('city');
        $league->provice_state = request('province_state');
        $league->name = request('name');
        $league->description = request('leaguedescription');
        $league->admin_username = $adminusername;
        $league->activityid = $activity->id;

        $league->save();

        $user->league_admin_flag = 1;

        $user->save();

        return redirect('/leagues');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $league = League::findOrFail($id);

      $leagueteams = DB::table('teams')
          ->where('teams.leagueid', '=', $id)
          ->get();

      $admin = DB::table('users')
          ->where('users.username', '=', $league->admin_username)
          ->first();
      //dd($admin);

      $userteams = DB::table('users')
          ->join('belongs_tos', 'users.username', '=', 'belongs_tos.username')
          ->join('teams', 'teams.id', '=', 'belongs_tos.teamid')
          ->where('belongs_tos.username', '=', Auth::user()->username)
          ->select('teams.*')
          ->get();

      return view('league.show', compact('league', 'leagueteams', 'admin', 'userteams'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function request($id)
    {
      $league = League::findOrFail($id);
      $usercaptainteams = DB::table('teams')
          ->where('teams.captain_username', '=', Auth::user()->username)
          ->whereNull('teams.leagueid')
          ->get();

      return view('league.request', compact('league', 'usercaptainteams'));
    }

    public function storeRequest(Request $request)
    {
      $leaguerequest = new RequestsToJoinLeague();

      $leaguerequest->teamid = $request->teamid;
      $leaguerequest->leagueid = $request->leagueid;
      $leaguerequest->content = $request->content;

      $leaguerequest->save();

      return redirect('/leagues');
    }

    public function viewRequests()
    {
      $leaguerequests = DB::table('requests_to_join_leagues')
          ->join('leagues', 'leagues.id', '=', 'requests_to_join_leagues.leagueid')
          ->where('leagues.admin_username', '=', Auth::user()->username)
          ->select('requests_to_join_leagues.*')
          ->get();
      $teams = Team::all();
      $leagues = League::all();
      return view('league.requests', compact('leaguerequests', 'teams', 'leagues'));
    }

    public function acceptRequest(Request $request)
    {

      $team = Team::findOrFail($request->teamid);

      $team->leagueid = $request->leagueid;

      $team->save();

      RequestsToJoinLeague::where('id', $request->requestid)->delete();

      return redirect('/leagues');
    }
}
