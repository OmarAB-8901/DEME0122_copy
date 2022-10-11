<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RolesController extends Controller
{
    public function index(Request $request)
    {
            $roles = Role::where('id','>','2')
            ->select('id','description','response_time')
            ->orderBy('id', 'desc')->get();
       
        return view('roles.index')->with(compact('roles'));
    }

    public function store(Request $request)
    {
            $role = new Role();
            $role->name = $request->name;
            $role->description = $request->name;
            $role->response_time = $request->response_time;
            $role->save();
            return Redirect::to('/roles');

    }

    public function update(Request $request)
    {
            $role = Role::findOrFail($request->id);
            $role->name = $request->name;
            $role->description = $request->name;
            $role->response_time = $request->response_time;
            $role->save();
            return Redirect::to('/roles');

    }
}
