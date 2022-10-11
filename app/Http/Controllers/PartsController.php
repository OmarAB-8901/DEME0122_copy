<?php

namespace App\Http\Controllers;

use App\Parts;
use App\HabSensores;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PartsController extends Controller
{
    public function index(Request $request)
    {
            $parts = Parts::select('id','name','description','ict','plan','condicion')->orderBy('name', 'asc')->get();

            $hab_sensor = HabSensores::select('id','conteo_pzs')->get();
     
        return view('parts.index')->with(compact('parts','hab_sensor'));
    }
    
    public function store(Request $request)
    {
        $parts = new Parts();
        $parts->name = $request->name;
        $parts->description = $request->description;
        $parts->ict= $request->ict;
        $parts->plan= $request->plan;
        $parts->condicion = '1';
        $parts->save();
        return Redirect::to('/parts');
    }
    public function update(Request $request)
    {
        $parts = Parts::findOrFail($request->id);
        $parts->name = $request->name;
        $parts->description = $request->description;
        $parts->ict= $request->ict;
        $parts->plan= $request->plan;
        $parts->condicion = '1';
        $parts->save();
        return Redirect::to('/parts');
    }

    public function desactivar(Request $request)
    {
        $parts = Parts::findOrFail($request->id);
        $parts->condicion = '0';
        $parts->save();
        return Redirect::to('/parts');
    }

    public function activar(Request $request)
    {
        $parts = Parts::findOrFail($request->id);
        $parts->condicion = '1';
        $parts->save();
        return Redirect::to('/parts');
    }

    public function HabSensor_activar(Request $request)
    {
        $hab_sensor = HabSensores::findOrFail($request->id);
        $hab_sensor->conteo_pzs = '1';
        $hab_sensor->save();
        return Redirect::to('/parts');
    }
    public function HabSensor_desactivar(Request $request)
    {
        $hab_sensor = HabSensores::findOrFail($request->id);
        $hab_sensor->conteo_pzs = '0';
        $hab_sensor->save();
        return Redirect::to('/parts');
    }
}
