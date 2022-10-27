<?php

namespace App\Http\Controllers;

use App\Models;
use App\HabSensores;
use App\Machine;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ModelsController extends Controller
{
    public function index(Request $request)
    {
            $models = Models::join('machines','models.idmachine','=','machines.id')
            ->select('models.id','models.name','description','valor_std','models.idmachine','machines.name as name_machine','models.condicion')->orderBy('models.name', 'asc')->get();

            $hab_sensor = HabSensores::select('id','conteo_pzs')->get();

            $machines = Machine::where('condicion','=','1')
            ->select('id','name')->orderBy('name', 'asc')->get();
     
        return view('models.index')->with(compact('models','hab_sensor','machines'));
    }
    
    public function store(Request $request)
    {
        $models = new Models();
        $models->name = $request->name;
        $models->description = $request->description;
        $models->valor_std= $request->valor_std;
        $models->idmachine = $request->idmachine;
        $models->condicion = '1';
        $models->save();
        return Redirect::to('/models');
    }
    public function update(Request $request)
    {
        $models = Models::findOrFail($request->id);
        $models->name = $request->name;
        $models->description = $request->description;
        $models->valor_std= $request->valor_std;
        $models->idmachine = $request->idmachine;
        $models->condicion = '1';
        $models->save();
        return Redirect::to('/models');
    }

    public function desactivar(Request $request)
    {
        $models = Models::findOrFail($request->id);
        $models->condicion = '0';
        $models->save();
        return Redirect::to('/models');
    }

    public function activar(Request $request)
    {
        $models = Models::findOrFail($request->id);
        $models->condicion = '1';
        $models->save();
        return Redirect::to('/models');
    }

    public function HabSensor_activar(Request $request)
    {
        $hab_sensor = HabSensores::findOrFail($request->id);
        $hab_sensor->conteo_pzs = '1';
        $hab_sensor->save();
        return Redirect::to('/models');
    }
    public function HabSensor_desactivar(Request $request)
    {
        $hab_sensor = HabSensores::findOrFail($request->id);
        $hab_sensor->conteo_pzs = '0';
        $hab_sensor->save();
        return Redirect::to('/models');
    }
}
