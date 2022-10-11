<?php

namespace App\Http\Controllers;

use App\Shifts;
use App\Groups;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ShiftController extends Controller
{
    public function index(Request $request)
    {

            $shift = Shifts::join('groups','groups.id','=','shifts.idgroup')
            ->select('shifts.id','shifts.name','shifts.start_time','shifts.end_time','shifts.condicion')
            ->orderBy('shifts.id', 'asc')->get();

            $groups = Groups::where('condicion','=','1')
            ->where('id','>','1')
            ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('shift.index')->with(compact('shift','groups'));
    }
    
    public function store(Request $request)
    {
        $shift = new Shifts();
        $shift->name = $request->name;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->idgroup = 1;
        $shift->condicion = '1';
        $shift->save();
        return Redirect::to('/shift');
    }
    public function update(Request $request)
    {
        $shift = Shifts::findOrFail($request->id);
        $shift->name = $request->name;
        $shift->start_time = $request->start_time;
        $shift->end_time = $request->end_time;
        $shift->idgroup = 1; 
        $shift->condicion = '1';
        $shift->save();
        return Redirect::to('/shift');
    }

    public function desactivar(Request $request)
    {
        $shift = Shifts::findOrFail($request->id);
        $shift->condicion = '0';
        $shift->save();
        return Redirect::to('/shift');
    }

    public function activar(Request $request)
    {
        $shift = Shifts::findOrFail($request->id);
        $shift->condicion = '1';
        $shift->save();
        return Redirect::to('/shift');
    }

}
