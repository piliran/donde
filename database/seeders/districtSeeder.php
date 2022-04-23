<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class districtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('districts')->insert([
            [
            'name'=>'Mzimba',
            ],
            [
            'name'=>'Mzuzu',
            ],
            [
            'name'=>'Lilongwe',
            ]
         ]);
    }
}
