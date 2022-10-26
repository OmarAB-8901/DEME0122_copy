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

        $planes = Planes::where('planes.condicion', '=','1')
        ->select('id','work_order')->orderBy('work_order', 'asc')->get();
        
        return view('graphics.button')->with(compact('planes'));
    }

    
}
