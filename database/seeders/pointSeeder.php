<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class pointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('points')->insert(
            [
            'name'=>'Jerusalem',
            'address'=>'24 Champhira',
            'city'=>'Mzuzu',
            'latitude'=>-15.7762085,
            'longitude'=>35.0307656,
 
        ]);
    }
}
