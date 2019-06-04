<?php

use Illuminate\Database\Seeder;

class CabinetsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cabinets')->insert([
            'number' => Str::random(10),
            'name' => Str::random(10).'@gmail.com',
            'cabinet_type' => bcrypt('secret'),
        ]);
    }
}
