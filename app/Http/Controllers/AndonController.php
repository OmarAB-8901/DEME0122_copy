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
        
        return view('graphics.button')->with(compact('planes','groups'));
    }

    
}
