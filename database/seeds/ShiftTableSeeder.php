<?php

use Illuminate\Database\Seeder;

use App\Shifts;

class ShiftTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shifts = new Shifts();
        $shifts->name = 'MATUTINO';
        $shifts->start_time = '7:00';
        $shifts->end_time = '19:00';
        $shifts->idgroup = 1;
        $shifts->save();

        $shifts = new Shifts();
        $shifts->name = 'NOCTURNO';
        $shifts->start_time = '19:00';
        $shifts->end_time = '07:00';
        $shifts->idgroup = 1;
        $shifts->save();

        $shifts = new Shifts();
        $shifts->name = 'FIN DE SEMANA';
        $shifts->start_time = '7:00';
        $shifts->end_time = '19:00';
        $shifts->idgroup = 1;
        $shifts->save();
    }
}
