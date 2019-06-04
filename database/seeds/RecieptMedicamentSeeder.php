<?php

use Illuminate\Database\Seeder;
use App\Reciept;
use App\Medicament;

class RecieptMedicamentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1; $i<=15; $i++){
            Reciept::find($i)->medicaments()->attach(Medicament::find(rand(1,15)));
            Reciept::find($i)->medicaments()->attach(Medicament::find(rand(1,15)));
        }
    }
}
