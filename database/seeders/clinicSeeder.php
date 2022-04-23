<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class clinicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('clinics')->insert(
        //     [
        //     'name'=>'Jerusalem',
        //     'address'=>'24 Champhira',
        //     'city'=>'Mzuzu',
        //     'latitude'=>28.452763,
        //     'longitude'=>-81.412228,

        // ],
        [
             'name'=>'Luwinga',
            'address'=>'20 Luwinga',
            'city'=>'Mzuzu',
            'latitude'=>11.4390,
            'longitude'=>34.0084,
        ]
    );
    }
}
