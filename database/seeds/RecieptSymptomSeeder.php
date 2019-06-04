<?php

use Illuminate\Database\Seeder;
use App\Reciept;
use App\Symptom;

class RecieptSymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=15; $i++){
            Reciept::find($i)->medicaments()->attach(Symptom::find(rand(1,10)));
        }
    }
}
