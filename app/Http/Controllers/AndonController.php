<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Machine;
use App\Planes;

class AndonController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $planes = Planes::join('machines','planes.idmachine','=','machines.id')
        ->where('planes.condicion', '=','1')
        ->select('planes.id','orden_trabajo','planes.idmachine','machines.name as name_machine')->orderBy('orden_trabajo', 'asc')->get();
        
        return view('graphics.button')->with(compact('planes'));
    }

    
}
