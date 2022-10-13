<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\OeeExport;
use Carbon\Carbon;
use App\Machine;
use DB;

class OeeController extends Controller
{
    
    public function index($idmachine)
    {
        $date = Carbon::now();
        $date = $date->format('Y-m-d');
        $caso = "d";

        $machines = Machine::where('id','=', $idmachine)
           ->select('id','name')->orderBy('name', 'asc')->get();
        
       
        return view('graphics.oee')->with(compact('machines','date'));
    }

    public function datos($idmachine,$caso,$date,$casoS,$partId,$lotId,$idShift)
    {    
            if($idShift=="all"){
                $idShift=1;
            }
            
            $DB_SP = "call";
            $DB_SP_START= "(";
            $DB_SP_END= ")";
            
            $idgroup = auth()->user()->idgroup;
            $oee = DB::select($DB_SP.' ConsultaOEETrends '.$DB_SP_START.'?,?,?,?,?,?,?'.$DB_SP_END,array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeepro = DB::select($DB_SP.' ConsultaOEEDoughnut '.$DB_SP_START.'?,?,?,?,?,?,?'.$DB_SP_END,array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeeGrid = DB::select($DB_SP.' ConsultaOEETrendsGrid '.$DB_SP_START.'?,?,?,?,?,?,?,?'.$DB_SP_END,array($caso,$idgroup,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
            $oeeComponet = DB::select($DB_SP.' ConsultaOEEComponentes '.$DB_SP_START.'?,?,?,?,?,?,?'.$DB_SP_END,array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));

            $partId = DB::select($DB_SP.' ConsultaSelectpartId '.$DB_SP_START.'?,?,?'.$DB_SP_END,array($caso,$idmachine,$date));
            $lotId = DB::select($DB_SP.' ConsultaSelectlotId '.$DB_SP_START.'?,?,?'.$DB_SP_END,array($caso,$idmachine,$date));
            $turno = DB::select($DB_SP.' ConsultaSelectidShift '.$DB_SP_START.'?,?,?,?'.$DB_SP_END,array($caso,$idgroup,$idmachine,$date));

        return array ($oee,$oeepro,$oeeGrid,$oeeComponet,$partId,$lotId,$turno);
    }

    public function export($idmachine,$caso,$date,$casoS,$partId,$lotId,$idShift,$nomvar)
    {
        if($idShift=="all"){
            $idShift=1;
        }
        $idgroup = auth()->user()->idgroup;
        return (new OeeExport)->datos($idmachine,$caso,$date,$idgroup,$casoS,$partId,$lotId,$idShift,$nomvar)->download("ReporteOee$nomvar$date.xlsx");
    }

    // public function andon($idmachine)
    // {
    //     $date = Carbon::now();
    //     $date = $date->format('Y-m-d');
    //     $caso = "d";

    //     $machines = Machine::where('id','=', $idmachine)
    //        ->select('id','name')->orderBy('name', 'asc')->get();
        
       
    //     return view('graphics.andon')->with(compact('machines','date'));
    // }
    public function datosandon($idmachine,$caso,$date,$casoS)
    {
        $partId = '0';
        $lotId ='0';
        $idShift = 1; 
        $DB_SP = env('DB_SP');   
        $DB_SP_START= env('DB_SP_START');
        $DB_SP_END= env('DB_SP_END');

        $oeepro = DB::select($DB_SP.' ConsultaOEEDoughnut '.$DB_SP_START.'?,?,?,?,?,?,?'.$DB_SP_END,array($caso,$idmachine,$date,$casoS,$partId,$lotId,$idShift));
        
       
        return array ($oeepro);
    }
}
