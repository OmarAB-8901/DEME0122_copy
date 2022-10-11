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
        $request->user()->authorizeRoles(['user', 'admin','operador', 'andon']);

        if ($request->user()->hasRole('operador')) {
            return Redirect::to('/button/andon');
        }else if ($request->user()->hasRole('andon')) {
            return Redirect::to('/andon');
            
        }else {
            return view('home');
        }
        
    }
}
