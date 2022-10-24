<?php

namespace App\Http\Controllers;

use App\Planes;
use App\Models;
use App\Machine;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PlanesController extends Controller
{
    public function index(Request $request)
    {
            $planes = Planes::join('machines','planes.idmachine','=','machines.id')
            ->select('planes.id','orden_trabajo','modelo','planes.idmachine','machines.name as name_machine','lote','ict','plan','planes.condicion')->orderBy('name', 'asc')->get();

            $models = Models::select('id','name')->orderBy('name', 'asc')->get();

            $machines = Machine::where('condicion','=','1')
            ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('planes.index')->with(compact('planes','models','machines'));
    }
    
    public function store(Request $request)
    {
        $planes = new Planes();
        $planes->orden_trabajo = $request->orden_trabajo;
        $planes->modelo = $request->model;
        $planes->idmachine = $request->idmachine;
        $planes->lote= $request->lote;
        $planes->ict = $request->ict;
        $planes->plan = $request->plan;
        $planes->condicion = '1';
        $planes->save();
        return Redirect::to('/planes');
    }
    public function update(Request $request)
    {
        $planes = Planes::findOrFail($request->id);
        $planes->orden_trabajo = $request->orden_trabajo;
        $planes->modelo = $request->model;
        $planes->idmachine = $request->idmachine;
        $planes->lote= $request->lote;
        $planes->ict = $request->ict;
        $planes->plan = $request->plan;
        $planes->condicion = '1';
        $planes->save();
        return Redirect::to('/planes');
    }

    public function desactivar(Request $request)
    {
        $planes = Planes::findOrFail($request->id);
        $planes->condicion = '0';
        $planes->save();
        return Redirect::to('/planes');
    }

    public function activar(Request $request)
    {
        $planes = Planes::findOrFail($request->id);
        $planes->condicion = '1';
        $planes->save();
        return Redirect::to('/planes');
    }
}
