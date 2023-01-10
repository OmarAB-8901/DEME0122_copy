<?php

namespace App\Http\Controllers;

use App\Scraps;
use App\Ttypes;
use App\Defectos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CalidadController extends Controller
{
    public function index(Request $request)
    {
            $calidad = Defectos::join('scraps','scraps.id','=','defectos.idScrap')
            ->join('Ttypes','Ttypes.codigo','=','scraps.identifier')
            ->select('defectos.id','defectos.fecha','defectos.fecha','Ttypes.descrip','scraps.name','scraps.description','defectos.cantidad','defectos.isdefect')->get();
       
        return view('calidad.index')->with(compact('calidad'));
    }

    public function desactivar(Request $request)
    {
        $calidad = Defectos::findOrFail($request->id);
        $calidad->isdefect = '1';
        $calidad->save();
        return Redirect::to('/calidad');
    }

    public function activar(Request $request)
    {
        $calidad = Defectos::findOrFail($request->id);
        $calidad->isdefect = '0';
        $calidad->save();
        return Redirect::to('/calidad');
    }
}
