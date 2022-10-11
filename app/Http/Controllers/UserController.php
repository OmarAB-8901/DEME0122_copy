<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use App\Groups;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index(Request $request)
    {
            $personas = User::join('role_user','users.id','=','role_user.user_id')
            ->join('roles','role_user.role_id','=','roles.id')
            ->select('users.id','role_user.role_id','roles.description as name_rol','users.name','users.email','users.condicion','users.notificaciones')
            ->orderBy('users.id', 'desc')->get();

            $roles = Role::where('id','>','2')
            ->select('id','description')->orderBy('name', 'asc')->get();
       
        return view('users.index')->with(compact('personas','roles'));
    }

    public function store(Request $request)
    {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt( $request->password);
            $user->idgroup = 1;
            $user->condicion = '1';  
            $user->notificaciones = $request->notif ? true : false;     
            $user->save();
            $user->roles()->attach($request->idrol);
            return Redirect::to('/user');

    }

    public function update(Request $request)
    {
            $user = User::findOrFail($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt( $request->password);
            $user->idgroup = 1;
            $user->condicion = '1';
            $user->notificaciones = $request->notif ? true : false; 
            $user->save();
            $user->roles()->sync($request->idrol);
            return Redirect::to('/user');

    }

    public function desactivar(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->condicion = '0';
        $user->save();
        return Redirect::to('/user');
    }

    public function activar(Request $request)
    {
        
        $user = User::findOrFail($request->id);
        $user->condicion = '1';
        $user->save();
        return Redirect::to('/user');
    }
}
