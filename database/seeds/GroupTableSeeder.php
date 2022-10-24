<?php

use Illuminate\Database\Seeder;
use App\Groups;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new Groups();
        $group->name = 'General';
        $group->save();

        $group = new Groups();
        $group->name = 'Mantenimiento';
        $group->save();

        $group = new Groups();
        $group->name = 'Mantenimiento';
        $group->save();

        $group = new Groups();
        $group->name = 'Materiales';
        $group->save();

        $group = new Groups();
        $group->name = 'Calidad';
        $group->save();

        $group = new Groups();
        $group->name = 'Personal';
        $group->save();
    }


}
