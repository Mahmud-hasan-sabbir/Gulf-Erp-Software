<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setup;

class SetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //______________ Setup ________________//
        Setup::create([
            'install_technician'=> 10,
            'services_technician'=> 9,
        ]);
        
    }
}
