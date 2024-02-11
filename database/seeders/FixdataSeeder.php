<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ReferenceType;

class FixdataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //____________ SL MOVEMENTS ______________//
        ReferenceType::create([
            'name'=>'Purchase',
            'status'=>'1',
        ]);
        ReferenceType::create([
            'name'=>'Sales',
            'status'=>'1',
        ]);
        ReferenceType::create([
            'name'=>'Store Transfer',
            'status'=>'1',
        ]);
        ReferenceType::create([
            'name'=>'Sales Return',
            'status'=>'1',
        ]);
    }
}
