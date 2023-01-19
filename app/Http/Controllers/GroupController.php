<?php

namespace App\Http\Controllers;
use App\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class GroupController extends Controller
{
    public function index(Request $request)
    {

            $groups = Groups::where('id','>','1')
            ->select('id','name','condicion')
            ->orderBy('id', 'desc')->get();

        return view('groups.index')->with(compact('groups'));
    }
    
    public function store(Request $request)
    {
        $groups = new Groups();
        $groups->name = $request->name; 
        $groups->condicion = '1';
        $groups->save();
        return Redirect::to('/groups');
    }
    public function update(Request $request)
    {
        $groups = Groups::findOrFail($request->id);
        $groups->name = $request->name; 
        $groups->condicion = '1';
        $groups->save();
        return Redirect::to('/groups');
    }

    public function desactivar(Request $request)
    {
        $groups = Groups::findOrFail($request->id);
        $groups->condicion = '0';
        $groups->save();
        return Redirect::to('/groups');
    }

    public function activar(Request $request)
    {
        $groups = Groups::findOrFail($request->id);
        $groups->condicion = '1';
        $groups->save();
        return Redirect::to('/groups');
    }
    public function listMachinesGroup(){
        $id = auth()->user()->idgroup; 
        $condicion = '1';
        $groups = Groups::join('machines','groups.id','=','machines.idgroup')
            ->select('machines.id','machines.name as name_machine','machines.activar_oee','machines.activar_eventos')
            ->where('groups.id','=', $id)
            ->where('machines.condicion','=', $condicion)->get();    
            
        return  $groups;
    }
}
