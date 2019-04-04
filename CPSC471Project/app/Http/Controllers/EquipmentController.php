<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\League;
use App\Equipment;
use DB;

use Auth;

class EquipmentController extends Controller
{
  public function index($leagueid)
  {
    $equipment = DB::table('equipment')->where('leagueid', '=', $leagueid)->get();
    $league = League::findOrFail($leagueid);


    return view('equipment.index', compact('equipment', 'league'));
  }

  public function add($leagueid)
  {
    $league = League::findOrFail($leagueid);

    return view('equipment.addequipment', compact('league'));
  }

  public function store(Request $request)
  {
    $equipment = new Equipment();
    $equipment->name = $request->name;
    $equipment->price = $request->price;
    $equipment->leagueid = $request->leagueid;

    $equipment->save();

    return redirect('/leagues/'. $request->leagueid);
  }

}
