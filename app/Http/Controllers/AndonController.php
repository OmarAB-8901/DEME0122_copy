<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Machine;
use App\Planes;
use App\Groups;
use DB;



class AndonController extends Controller
{
    public function index($param1)
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
        $linea=Machine::where('id','=',$param1)
        ->select('name','id')->get();
        return view('andon_lider.button')->with(compact('planes','groups','work_order','piezas_ok','piezas_scrap','linea'));
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

        
        return view('andon_lider.button')->with(compact('work_order','planes', 'piezas_ok','piezas_scrap'));
    }

   
        /*Consulta del organigrama de atención en el sistema */
        public function ConsultaOrgCharts($param1,$param2,$param3){  
                $DB_SP = "EXECUTE";
                $DB_SP_START= "";
                $DB_SP_END= "";        
                $orgchart1 = DB::select($DB_SP.' ConsultaOrgCharts '.$DB_SP_START.'?,?,?'.$DB_SP_END,array($param1,$param2,$param3));        
                return array ($orgchart1);
                /*  http://127.0.0.1:8000/button/andon/orgchart/1/1/1
                    DB: execute ConsultaOrgCharts 1/1/1 */
        }

        public function ConsultaInfoAndon($param1,$param2,$param3)        {  
                $DB_SP = "EXECUTE";
                $DB_SP_START= "";
                $DB_SP_END= "";        
                $orgchart = DB::select($DB_SP.' ConsultaInfoAndon '.$DB_SP_START.'?,?,?'.$DB_SP_END,array($param1,$param2,$param3));        
                return array ($orgchart);
                /*  http://127.0.0.1:8000/button/andon/orgchart/2/'1'/'1'
                    DB: execute ConsultaOrgCharts 1/1/1 */        
                }

        public function ConsultaEstaciones($param1,$param2,$param3){
                $DB_SP = "EXECUTE";
                $DB_SP_START= "";
                $DB_SP_END= "";        
                $orgchart = DB::select($DB_SP.' ConsultaInfoEstacion '.$DB_SP_START.'?,?,?'.$DB_SP_END,array($param1,$param2,$param3));        
                return array ($orgchart);
                /*  http://127.0.0.1:8000/button/andon/orgchart/1/1/1
                    DB: execute ConsultaOrgCharts 1/1/1 */       

                }    
        public function SetDefectos($param1,$param2,$param3,$param4){
                    $DB_SP = "EXECUTE";
                    $DB_SP_START= "";
                    $DB_SP_END= "";        
                    $defectos = DB::statement($DB_SP.' sp_SetDefectos '.$DB_SP_START.'?,?,?,?'.$DB_SP_END,array($param1,$param2,$param3,$param4));        
                    return array ($defectos);
                    /* http://127.0.0.1:8000/button/andon/setdefectos/{param1}/{param2}/{param3}/{param4}
                       
                        //execute sp_SetDefectos '7002',2,1,'F12201230D'*/
    
                    }    

  
                    

        public function SetPersonal(Request $request)
                        {
                            $DB_SP = "EXECUTE";
                            $DB_SP_START= "";
                            $DB_SP_END= "";        
                            $defectos = DB::statement($DB_SP.' sp_SetPersonal '.$DB_SP_START.'?,?,?,?'.$DB_SP_END,array($param1,$param2,$param3,$param4));        
                            return array ($defectos);                         
                            
                            
                        }            
           

        public function ConsultaEventos($param1,$param2,$param3){
                            $DB_SP = "EXECUTE";
                            $DB_SP_START= "";
                            $DB_SP_END= "";        
                            $eventos = DB::select($DB_SP.' sp_control_events '.$DB_SP_START.'?,?,?'.$DB_SP_END,array($param1,$param2,$param3));        
                            return array ($eventos);
                            /*  http://127.0.0.1:8000/button/andon/orgchart/1/1/1
                                DB: execute ConsultaOrgCharts 1/1/1 */       
            
                            }    
            
        public function SetEventos($param1,$param2,$param3,$param4)
                            {
                                $DB_SP = "EXECUTE";
                                $DB_SP_START= "";
                                $DB_SP_END= "";        
                                $defectos = DB::statement($DB_SP.' sp_SetAtencion '.$DB_SP_START.'?,?,?,?'.$DB_SP_END,array($param1,$param2,$param3,$param4));        
                                return array ($defectos);   
                            }            
               
                    

    
}
