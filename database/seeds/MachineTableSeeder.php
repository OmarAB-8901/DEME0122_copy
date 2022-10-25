<?php

use Illuminate\Database\Seeder;

use App\Machine;

class MachineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $machine = new Machine();
        $machine->idgroup = 1;
        $machine->name = 'Linea 77 Hydromark Pouch';
        $machine->activar_oee = 1;
        $machine->activar_eventos = 1;
        $machine->condicion = 1;
        $machine->save();

        $machine = new Machine();
        $machine->idgroup = 1;
        $machine->name = 'Linea 77 Hydromark Gel';
        $machine->activar_oee = 1;
        $machine->activar_eventos = 1;
        $machine->condicion = 1;
        $machine->save();
    }
}
