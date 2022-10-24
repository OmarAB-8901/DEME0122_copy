<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Role::where('name', 'Supervisor Mantenimiento')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_admin = Role::where('name', 'Lider')->first();

        $user = new User();
        $user->name = 'Jorge Aguilar';
        $user->email = 'Jorge.Aguilar@mammotome.com';
        $user->password = bcrypt('Server2106');
        $user->idgroup = 1;
        $user->notificaciones= 1;
        $user->save();
        $user->roles()->attach($role_user);

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@mammotome.com';
        $user->password = bcrypt('Server2106');
        $user->idgroup = 1;
        $user->notificaciones= 0;
        $user->save();
        $user->roles()->attach($role_admin);

        $user = new User();
        $user->name = 'Lider';
        $user->email = 'lider@mammotome.com';
        $user->password = bcrypt('Server2106');
        $user->idgroup = 1;
        $user->notificaciones= 0;
        $user->save();
        $user->roles()->attach($role_admin);
     }
}
