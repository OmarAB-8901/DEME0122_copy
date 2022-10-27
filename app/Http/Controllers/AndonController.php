<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Machine;
use App\Planes;
use App\Groups;

class AndonController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $planes = Planes::where('planes.condicion', '=','1')
        ->select('id','work_order')->orderBy('work_order', 'asc')->get();

        $groups = Groups::where('id','>','1')
            ->select('id','name','condicion')
            ->orderBy('id', 'desc')->get();

        $work_order = Planes::where('work_order','=',0)
            ->join('models','models.id','=','planes.model')
            ->join('machines','models.idmachine','=','machines.id')
            ->select('work_order','models.name','models.description','valor_std','plan','machines.name')->orderBy('work_order', 'asc')->get();

        $piezas_ok = 0;
        $piezas_scrap = 0;
        
        return view('graphics.button')->with(compact('planes','groups','work_order','piezas_ok','piezas_scrap'));
    }


    public function const_work_order(Request $request)
    {
        
        $work_order = Planes::where('planes.id','=',$request->work_order)
        ->join('models','models.id','=','planes.model')
        ->join('machines','models.idmachine','=','machines.id')
        ->select('work_order','models.name as model','models.description','valor_std','plan','machines.name')->orderBy('work_order', 'asc')->get();

        $planes = Planes::where('planes.condicion', '=','1')
        ->select('id','work_order')->orderBy('work_order', 'asc')->get();

        $piezas_ok = 0;
        $piezas_scrap = 0;

        
        return view('graphics.button')->with(compact('work_order','planes', 'piezas_ok','piezas_scrap'));
    }

    
}
