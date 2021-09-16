<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //add two genders to the database
        $genders = DB::table('gender_types')->insert([
            [
                'gender_name' => 'Male',
            ],
            [
                'gender_name' => 'Female',
            ],
        ]);
    }
}
