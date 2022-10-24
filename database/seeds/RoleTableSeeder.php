<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->response_time = 3;
        $role->save();

        $role = new Role();
        $role->name = 'Lider';
        $role->description = 'Lider';
        $role->response_time = 3;
        $role->save();

        $role = new Role();
        $role->name = 'Tecnico';
        $role->description = 'Tecnico';
        $role->response_time = 3;
        $role->save();

        $role = new Role();
        $role->name = 'Supervisor Mantenimiento';
        $role->description = 'Supervisor Mantenimiento';
        $role->response_time = 3;
        $role->save();

        $role = new Role();
        $role->name = 'Supervisores de Manufactura';
        $role->description = 'Supervisores de Manufactura';
        $role->response_time = 3;
        $role->save();

        $role = new Role();
        $role->name = 'Gerentes de Manufactura';
        $role->description = 'Gerentes de Manufactura';
        $role->response_time = 3;
        $role->save();

        $role = new Role();
        $role->name = 'Gerente de Planta';
        $role->description = 'Gerente de Planta';
        $role->response_time = 3;
        $role->save();


    }
}
