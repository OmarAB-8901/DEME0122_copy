<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrgChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org_chart = OrgCharts::where('cond','=',1)            
            ->select('nameorg','idgroup','ord_num','time1','time2','cond')->orderBy('ord_num', 'asc')->get();
            return $org_chart;
    
        }

    /**
     * Borrar el controlador a diciembre 2022.
     *
     * 
     */
   

    
}
