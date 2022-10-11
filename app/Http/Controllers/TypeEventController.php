<?php

namespace App\Http\Controllers;

use App\TypeEvent;
use App\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TypeEventController extends Controller
{
    public function index(Request $request)
    {

            $typeevents = TypeEvent::join('groups','groups.id','=','type_events.idgroup')
            ->select('type_events.id','type_events.id_type','type_events.idgroup','type_events.name','groups.name as name_group','type_events.description','type_events.condicion')
            ->orderBy('type_events.id', 'asc')->get();

            $groups = Groups::where('condicion','=','1')
            ->where('id','>','1')
            ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('typeevent.index')->with(compact('typeevents','groups'));
    }
    
    public function store(Request $request)
    {
        $typeevent = new TypeEvent();
        $typeevent->id_type = $request->id_type;
        $typeevent->name = $request->name;
        $typeevent->idgroup = $request->idgroup;
        $typeevent->description = $request->description;
        $typeevent->condicion = '1';
        $typeevent->save();
        return Redirect::to('/typeevent');
    }
    public function update(Request $request)
    {
        $typeevent = TypeEvent::findOrFail($request->id);
        $typeevent->name = $request->name;
        $typeevent->idgroup = $request->idgroup; 
        $typeevent->description = $request->description;
        $typeevent->condicion = '1';
        $typeevent->save();
        return Redirect::to('/typeevent');
    }

    public function desactivar(Request $request)
    {
        $typeevent = TypeEvent::findOrFail($request->id);
        $typeevent->condicion = '0';
        $typeevent->save();
        return Redirect::to('/typeevent');
    }

    public function activar(Request $request)
    {
        $typeevent = TypeEvent::findOrFail($request->id);
        $typeevent->condicion = '1';
        $typeevent->save();
        return Redirect::to('/typeevent');
    }

}
