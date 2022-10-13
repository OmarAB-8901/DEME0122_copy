<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Machine;
use App\Parts;

class AndonController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $machines = Machine::where('condicion', '=','1')
        ->select('machines.id','machines.name')->orderBy('name', 'asc')->get();

        $parts = Parts::where('condicion', '=','1')
        ->select('id','name')->orderBy('name', 'asc')->get();
        
        return view('graphics.button')->with(compact('machines','parts'));
    }

    
}
