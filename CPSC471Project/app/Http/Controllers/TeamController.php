<?php

namespace App\Http\Controllers;

use App\Team;
use App\League;
use App\BelongsTo;
use App\Activity;
use App\User;
use App\RequestsToJoinTeam;
use DB;
use Illuminate\Http\Request;
use Auth;

class TeamController extends Controller
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
        $allteams = Team::all();
        $user = Auth::user();
        $allleagues = League::all();
        $belongstos = BelongsTo::all();
        $activities = Activity::all();
        return view('team.index', compact('allteams', 'user', 'allleagues', 'belongstos', 'activities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $team = new Team();
      $captainusername= Auth::user()->username;
      $belongsto= new BelongsTo();
      $user = Auth::user();

      $team->name = request('name');
      $team->captain_username = $captainusername;

      $team->save();

      $belongsto->username = $captainusername;
      $belongsto->teamid = $team->id;

      $belongsto->save();

      $user->captain_flag = 1;

      $user->save();

      return redirect('/teams');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $team = Team::findOrFail($id);
        //$teammembers = DB::select(DB::raw("SELECT users.id, users.username FROM users, belongs_tos, teams WHERE teams.id=$id AND belongs_tos.teamid = teams.id AND belongs_tos.username = users.username"));
        $teammembers = DB::table('users')
            ->join('belongs_tos', 'users.username', '=', 'belongs_tos.username')
            ->join('teams', 'teams.id', '=', 'belongs_tos.teamid')
            ->where('teams.id', '=', $id)
            ->select('users.*')
            ->get();

        $belongstos = BelongsTo::all();
        $teamsleague = League::find($team->leagueid);
        $captain = User::whereUsername($team->captain_username)->first();

        return view('team.show', compact('team', 'teammembers', 'teamsleague', 'captain', 'belongstos'));
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
      $team = Team::findOrFail($id);
      return view('team.request', compact('team'));
    }

    public function storeRequest(Request $request)
    {
      $teamrequest = new RequestsToJoinTeam();

      $teamrequest->teamid= $request->teamid;
      $teamrequest->username = Auth::user()->username;
      $teamrequest->content = $request->content;

      $teamrequest->save();

      return redirect('/teams');
    }

    public function viewRequests()
    {
      $teamrequests = DB::table('requests_to_join_teams')
          ->join('teams', 'teams.id', '=', 'requests_to_join_teams.teamid')
          ->join('users', 'users.username', '=', 'requests_to_join_teams.username')
          ->where('teams.captain_username', '=', Auth::user()->username)
          ->select('requests_to_join_teams.*')
          ->get();
      $teams = Team::all();
      return view('team.requests', compact('teamrequests', 'teams'));
    }

    public function acceptRequest(Request $request)
    {
      $belongs_to = new BelongsTo();
      $belongs_to->teamid = $request->teamid;
      $belongs_to->username = $request->username;

      $user = User::whereUsername($request->username)->first();
      $user->player_flag = 1;

      RequestsToJoinTeam::where('id', $request->requestid)->delete();

      $belongs_to->save();
      $user->save();

      return redirect('/teams');
    }
}
