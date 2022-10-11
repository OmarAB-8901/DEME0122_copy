<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Machine;
use App\Groups;
class MachineController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $machines = Machine::join('groups','groups.id','=','machines.idgroup')
        ->select('machines.id','machines.name','groups.id as id_group','groups.name as name_group','machines.activar_oee','machines.activar_eventos','machines.condicion')->orderBy('name', 'asc')->get();
        
        $groups = Groups::where('condicion','=','1')
            ->where('id','>','1')
            ->select('id','name')->orderBy('name', 'asc')->get();

        return view('machine.index')->with(compact('machines','groups'));
    } 
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $machine = new Machine();
        $machine->name = $request->name;
        $machine->idgroup = $request->idgroup;
        $machine->activar_oee = $request->oee ? true : false;
        $machine->activar_eventos = $request->eventos ? true : false;
        $machine->condicion = '1';

        $machine->save();
        return Redirect::to('/machine');
    }
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Machine $machine)
    {
        $machine = Machine::findOrFail($request->id);
        $machine->name = $request->name;
        $machine->idgroup = $request->idgroup;
        $machine->activar_oee = $request->oee ? true : false;
        $machine->activar_eventos = $request->eventos ? true : false;
        $machine->condicion = '1';
        $machine->save();
        return Redirect::to('/machine');
    }

    public function desactivar(Request $request)
    {
        $machine = Machine::findOrFail($request->id);
        $machine->condicion = '0';
        $machine->save();
        return Redirect::to('/machine');
    }

    public function activar(Request $request)
    {
        $machine = Machine::findOrFail($request->id);
        $machine->condicion = '1';
        $machine->save();
        return Redirect::to('/machine');
    }
}
