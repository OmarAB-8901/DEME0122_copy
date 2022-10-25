<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(GroupTableSeeder::class);
        $this->call(RoleTableSeeder::class); 
        $this->call(UserTableSeeder::class);
        $this->call(MachineTableSeeder::class);
        $this->call(Hab_sensorTableSeeder::class);
    }
}
