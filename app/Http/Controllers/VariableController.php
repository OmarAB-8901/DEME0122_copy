<?php

namespace App\Http\Controllers;

use App\Variable;
use App\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class VariableController extends Controller
{
    public function index(Request $request)
    {
     
         $variables = Variable::join('machines','variables.idmachine','=','machines.id')
            ->select('variables.id','variables.idmachine','variables.name','variables.description','variables.idmachine','machines.name as name_machine','variables.eu','variables.condicion')->get();
       
         $machines = Machine::where('condicion','=','1')
            ->select('id','name')->orderBy('name', 'asc')->get();

        return view('variables.index')->with(compact('variables','machines'));
    }
    
    public function store(Request $request)
    {
        $variable = new Variable();
        $variable->idmachine = $request->idmachine;
        $variable->name = $request->name;
        $variable->description = $request->description;
        $variable->eu = $request->eu;
        $variable->condicion = '1';
        $variable->save();
        return Redirect::to('/variable');
    }
    public function update(Request $request)
    {
        $variable = Variable::findOrFail($request->id);
        $variable->idmachine = $request->idmachine;
        $variable->name = $request->name;
        $variable->description = $request->description;
        $variable->eu = $request->eu;
        $variable->condicion = '1';
        $variable->save();
        return Redirect::to('/variable');
    }

    public function desactivar(Request $request)
    {
        $variable = Variable::findOrFail($request->id);
        $variable->condicion = '0';
        $variable->save();
        return Redirect::to('/variable');
    }

    public function activar(Request $request)
    {
        $variable = Variable::findOrFail($request->id);
        $variable->condicion = '1';
        $variable->save();
        return Redirect::to('/variable');
    }

    public function listVaribles($id_maquines){
        $variables = Variable::where('idmachine', '=',$id_maquines)
            ->select('id','name')
            ->orderBy('id', 'asc')->get();
        return  $variables;
    }


}
