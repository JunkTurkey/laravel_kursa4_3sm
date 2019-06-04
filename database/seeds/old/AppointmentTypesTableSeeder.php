<?php

use Illuminate\Database\Seeder;

class AppointmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('appointment_types')->insert([
            'description' => Str::random(10),
        ]);
    }
}
