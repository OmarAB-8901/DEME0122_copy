<?php

use Illuminate\Database\Seeder;

use App\HabSensores;

class Hab_sensorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new HabSensores();
        $group->conteo_pzs = 1;
        $group->save();
    }
}
