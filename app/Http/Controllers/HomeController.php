<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['user', 'admin','plan','Calidad','Supervisor Mantenimiento','Supervisores de Manufactura','Gerentes de Manufactura','Gerente de Planta']);

        if ($request->user()->hasRole('Lider')) {
            return Redirect::to('/button/andon');
        }else {
            return view('home');
        }
        
    }
}
