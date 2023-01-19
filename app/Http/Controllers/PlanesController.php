<?php

namespace App\Http\Controllers;

use App\Planes;
use App\Models;
use App\MAchines;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PlanesController extends Controller
{
    public function index(Request $request)
    {
        $planes = Planes::join('models','models.id','=','planes.model')        
        ->select('planes.id','work_order','model','models.name','lotId','plan','planes.condicion','cantasoc') 
        ->where('planes.condicion','=',1)
        ->orderBy('work_order', 'desc')->get();

        $models = Models::select('id','name')->orderBy('name', 'asc')->get();
            
        return view('planes.index')->with(compact('planes','models'));
    }
    
    public function store(Request $request)
    {
        $planes = new Planes();
        $planes->work_order = $request->orden_trabajo;
        $planes->model = $request->model;
        $planes->lotId= $request->lote;
        $planes->plan = $request->plan;
        $planes->condicion = '1';
        $planes->cantasoc=$request->cantasoc;
        $planes->save();
        return Redirect::to('/planes');
    }
    public function update(Request $request)
    {
        $planes = Planes::findOrFail($request->id);
        $planes->work_order = $request->orden_trabajo;
        $planes->model = $request->model;       
        $planes->lotId= $request->lote;
        $planes->plan = $request->plan;
        $planes->cantasoc= $request->cantasoc;
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
