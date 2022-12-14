<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use App\Machine;
use DB;


class AndonOEEController extends Controller
{
    public function index($idmachine)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');

        $machines = Machine::where('id','=', $idmachine)
           ->select('id','name')->orderBy('name', 'asc')->get();
        
        
        return view('andon_oee.andonoee')->with(compact('date','machines'));
    }

    public function consultaoee($param1,$param2,$param3){
        $DB_SP = "EXECUTE";
        $DB_SP_START= "";
        $DB_SP_END= "";        
        $orgchart = DB::select($DB_SP.' sp_oee '.$DB_SP_START.'?,?,?'.$DB_SP_END,array($param1,$param2,$param3));        
        return array ($orgchart);
        

        }    

}
