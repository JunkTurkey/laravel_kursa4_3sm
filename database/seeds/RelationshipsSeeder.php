<?php

use Illuminate\Database\Seeder;

class RelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->doctors();
        $this->cabinets();
        $this->reciepts();
        $this->appointments();
        $this->medicaments();
        $this->equipment();
        $this->reciepts();
    }

    private function appointments()
    {
        for ($i=1; $i<=60; $i++){
            DB::table('appointments')->where('id', $i)->update([
                'doctor_id' => rand(1,15),
                'patient_id' => rand(16,30),
                'appointment_type_id' => rand(1,4),
                'status_id' => rand(1,3),
            ]);
        }
    }

    private function cabinets()
    {
        for ($i=1; $i<=15; $i++) {
            DB::table('cabinets')->where('id', $i)->update([
                'cabinet_type_id' => DB::table('doctors')->where('id',$i)->value('speciality_id'),
            ]);
        }
    }

    private function doctors(){
        for ($i=1; $i<=15; $i++) {
            DB::table('doctors')->where('id', $i)->update([
                'user_id' => $i+1,
                'speciality_id' => rand(1,3),
                'cabinet_id' => $i,
            ]);
        }
    }

    private function equipment()
    {
        for ($i=1; $i<=45; $i++) {
            $randNum = rand(1,3);
            DB::table('equipment')->where('id', $i)->update([
                'cabinet_type_id' => $randNum,
                'equipment_type_id' => $randNum,
            ]);
        }
    }

    private function medicaments()
    {
        for ($i=1; $i<=15; $i++) {
            DB::table('medicaments')->where('id', $i)->update([
                'medicament_type_id' => rand(1,4),
            ]);
        }
    }

    private function reciepts(){
        for ($i=1; $i<=15; $i++) {
            DB::table('reciepts')->insert([
                'payment_id' => rand(1,15),
                'appointment_id' => rand(1,60),
            ]);
        }
    }

}
