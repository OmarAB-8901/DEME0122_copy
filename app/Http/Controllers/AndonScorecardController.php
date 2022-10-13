<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DB;

class AndonScorecardController extends Controller
{
    public function index(Request $request)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        
        return view('andon_scorecard.andonscore')->with(compact('date'));
    }
}
