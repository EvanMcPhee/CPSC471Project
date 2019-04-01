<?php

namespace App\Http\Controllers;

use App\Team;
use App\League;
use App\BelongsTo;
use App\Activity;

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

      $team->name = request('name');
      $team->captain_username = $captainusername;

      $team->save();

      $belongsto->username = $captainusername;
      $belongsto->teamid = $team->id;

      $belongsto->save();

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
        //
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
}
