<?php

namespace App\Http\Controllers;
use App\Areas;
use App\Machine;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AreasController extends Controller
{
    public function index(Request $request)
    {
            $areas = Areas::join('machines','areas.idmachines','=','machines.id')
            ->select('areas.id','areas.pos','areas.namearea','areas.idmachines','machines.name as name_machine','areas.condition')->orderBy('areas.idmachines', 'asc')->get();

            $machines = Machine::where('condicion','=','1')
            ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('areas.index')->with(compact('areas','machines'));
    }
    
    public function store(Request $request)
    {
        $posmax = Areas::where('idmachines','=', $request->idmachine)
        ->max('pos');

        $areas = new Areas();
        $areas->pos = $posmax+1;
        $areas->namearea = $request->name;
        $areas->idmachines = $request->idmachine;
        $areas->condition = '1';
        $areas->save();
        return Redirect::to('/areas');
    }
    public function update(Request $request)
    {
        $posold = Areas::where('id','=', $request->id)
        ->select('pos')->get();

        foreach($posold as $var) {
           $posoldvalue= $var['pos'];  
        }

        $possust = Areas::where('idmachines','=', $request->idmachine)
        ->where('pos','=', $request->pos)
        ->select('id')->get();

        foreach($possust as $var) {
            $possustvalue= $var['id'];
        }
        

        $areas = Areas::findOrFail($request->id);
        $areas->pos = $request->pos;
        $areas->namearea = $request->name;
        $areas->idmachines = $request->idmachine;
        $areas->condition = '1';
        $areas->save();

        $areas = Areas::findOrFail($possustvalue);
        $areas->pos = $posoldvalue;
        $areas->save();


        return Redirect::to('/areas');
    }

    public function desactivar(Request $request)
    {
        $areas = Areas::findOrFail($request->id);
        $areas->condition = '0';
        $areas->save();
        return Redirect::to('/areas');
    }

    public function activar(Request $request)
    {
        $areas = Areas::findOrFail($request->id);
        $areas->condition = '1';
        $areas->save();
        return Redirect::to('/areas');
    }
}
