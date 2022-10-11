<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TrendsExport;
use Carbon\Carbon;
use App\Variable;
use DB;

class TrendsController extends Controller
{
    public function index($idvariable)
    {
            
            $date = Carbon::now();
            $date = $date->format('Y-m-d'); 
            
            $variables = Variable::where('variables.id', '=',$idvariable)
            ->join('machines','variables.idmachine','=','machines.id')
            ->select('variables.id','variables.idmachine','variables.name','variables.description','variables.idmachine','machines.name as name_machine','variables.eu','variables.condicion')->get();

        return view('graphics.trends')->with(compact('variables','date'));
    }

    public function datos($idvariable,$caso,$date)
    {
        $DB_SP = env('DB_SP');
        $DB_SP_START= env('DB_SP_START');
        $DB_SP_END= env('DB_SP_END');

        $trends = DB::select($DB_SP.' ConsultaTrends '.$DB_SP_START.'?,?,?'.$DB_SP_END,array($caso,$idvariable,$date));

        return $trends;
    }

    public function monitoreo($id)
    {
            $date = Carbon::now();
            $date = $date->format('Y-m-d H:i'); 
            $DB_SP = env('DB_SP');
            $DB_SP_START= env('DB_SP_START');
            $DB_SP_END= env('DB_SP_END');
            $monitoreo = DB::select($DB_SP.' ConsultaMonitoreovar '.$DB_SP_START.'?'.$DB_SP_END,array($date));

         return $monitoreo;
    }
    public function export($caso,$date,$idvar,$nomvar)
    {
        return (new TrendsExport)->datos($caso,$date,$idvar,$nomvar)->download("ReporteTrends$nomvar$date.xlsx");
    }
}
