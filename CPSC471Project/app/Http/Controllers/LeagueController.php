<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Activity;
use Auth;

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

        return view('league.index', compact('allleagues', 'allactivities', 'user'));
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
