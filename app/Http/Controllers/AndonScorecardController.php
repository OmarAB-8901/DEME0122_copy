<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Machine;
use DB;

class AndonScorecardController extends Controller
{
    public function index($idmachine)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $machines = Machine::where('id','=', $idmachine)
           ->select('id','name')->orderBy('name', 'asc')->get();
        
        return view('andon_scorecard.andonscore')->with(compact('date','machines'));
    }

    public function consultascore($param1,$param2,$param3)
    {
        $DB_SP = "EXECUTE";
        $DB_SP_START= "";
        $DB_SP_END= "";        
        $consultascored =DB::select($DB_SP.' sp_ConsultaProduccion  '.$DB_SP_START.'?,?,?'.$DB_SP_END,array($param1,$param2,$param3));              
        return array ( $consultascored );

    }
    
    


}
