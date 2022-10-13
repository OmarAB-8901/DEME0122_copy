<?php

namespace App\Http\Controllers;

use App\Scraps;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ScrapsController extends Controller
{
    public function index(Request $request)
    {
            $scraps = Scraps::select('id','identifier','name','description','condicion')->orderBy('name', 'asc')->get();
     
        return view('scrap.index')->with(compact('scraps'));
    }
    
    public function store(Request $request)
    {
        $scraps = new Scraps();
        $scraps->identifier = $request->identifier;
        $scraps->name = $request->name;
        $scraps->description = $request->description;
        $scraps->condicion = '1';
        $scraps->save();
        return Redirect::to('/scraps');
    }
    public function update(Request $request)
    {
        $scraps = Scraps::findOrFail($request->id);
        $scraps->identifier = $request->identifier;
        $scraps->name = $request->name;
        $scraps->description = $request->description;
        $scraps->condicion = '1';
        $scraps->save();
        return Redirect::to('/scraps');
    }

    public function desactivar(Request $request)
    {
        $scraps = Scraps::findOrFail($request->id);
        $scraps->condicion = '0';
        $scraps->save();
        return Redirect::to('/scraps');
    }

    public function activar(Request $request)
    {
        $scraps = Scraps::findOrFail($request->id);
        $scraps->condicion = '1';
        $scraps->save();
        return Redirect::to('/');
    }
}
