<?php

use Illuminate\Database\Seeder;

class RowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->appointments();
        $this->appointment_types();
        $this->statuses();
        $this->cabinets();
        $this->cabinet_types();
        $this->doctors();
        $this->equipment();
        $this->equipment_types();
        $this->medicaments();
        $this->medicament_types();
        $this->specialities();
        $this->symptoms();
        $this->payments();
    }

    private function appointments(){
        for ($i=1; $i<=60; $i++){
            DB::table('appointments')->insert([
                'appointed_at' => $this->getRandomDate('2018-1-1 01:00:00', '2018-06-01 23:00:00'),
            ]);
        }
    }

    private function statuses(){
        DB::table('statuses')->insert([
            'name' => 'open',
        ]);
        DB::table('statuses')->insert([
            'name' => 'accepted',
        ]);
        DB::table('statuses')->insert([
            'name' => 'closed',
        ]);
    }

    private function appointment_types(){
        DB::table('appointment_types')->insert([
            'description' => 'insection',
        ]);
        DB::table('appointment_types')->insert([
            'description' => 'procedures',
        ]);
        DB::table('appointment_types')->insert([
            'description' => 'massage',
        ]);
        DB::table('appointment_types')->insert([
            'description' => 'list confirmation',
        ]);

    }

    private function cabinets(){
        for ($i=1; $i<=15; $i++){
            DB::table('cabinets')->insert([
                'number' => $i,
                'name' => $this->getRandomSpeciality(),
            ]);
        }
    }

    private function cabinet_types(){
        DB::table('cabinet_types')->insert([
            'name' => 'dantistic',
        ]);
        DB::table('cabinet_types')->insert([
            'name' => 'massagistic',
        ]);
        DB::table('cabinet_types')->insert([
            'name' => 'universal',
        ]);
    }

    private function doctors()
    {
        for ($i=1; $i<=15; $i++) {
            DB::table('doctors')->insert([
                'phone' => '+375(29)' . rand(0, 9999999),
            ]);
        }
    }

    private function equipment(){
        for ($i=1; $i<=5; $i++) {
            DB::table('equipment')->insert([
                'name' => 'chair',
            ]);
            DB::table('equipment')->insert([
                'name' => 'drilling machine ',
            ]);
            DB::table('equipment')->insert([
                'name' => 'dental unit',
            ]);
            DB::table('equipment')->insert([
                'name' => 'lamp',
            ]);
            DB::table('equipment')->insert([
                'name' => 'fan',
            ]);
            DB::table('equipment')->insert([
                'name' => 'saliva ejector',
            ]);
            DB::table('equipment')->insert([
                'name' => 'screen',
            ]);
            DB::table('equipment')->insert([
                'name' => 'cupboard',
            ]);
            DB::table('equipment')->insert([
                'name' => 'table',
            ]);
        }
    }

    private function equipment_types(){
        DB::table('equipment_types')->insert([
            'type' => 'dantistic',
        ]);
        DB::table('equipment_types')->insert([
            'type' => 'massagistic',
        ]);
        DB::table('equipment_types')->insert([
            'type' => 'universal',
        ]);
    }

    private function medicaments(){
        DB::table('medicaments')->insert([
            'name' => 'Hemoban Topical Hemostatic Solution',
            'testimony' => 'allergic',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'HeliPLUG Collagen Wound Dressing',
            'testimony' => 'allergic',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'HeliTAPE Collagen Tape',
            'testimony' => 'allergic',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Gum Canker-X Gel',
            'testimony' => 'irritant',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Ethyl Chloride Topical Anesthetic',
            'testimony' => 'acne',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Debacterol Canker Sore Treatment',
            'testimony' => 'acne',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Zilactin Early Relief Cold Sore Gel',
            'testimony' => 'intoxication',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Hydrogen Peroxide',
            'testimony' => 'intoxication',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Diosmectite',
            'testimony' => 'intoxication',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Sodium Perborate Teeth Whitening',
            'testimony' => 'intoxication',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Calasept',
            'testimony' => 'diarrhea',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Sodium Hypochlorite Solution',
            'testimony' => 'diarrhea',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Chloroform',
            'testimony' => 'diarrhea',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Ammonia Inhalant',
            'testimony' => 'diarrhea',
        ]);
        DB::table('medicaments')->insert([
            'name' => 'Calcinase Liquid',
            'testimony' => 'diarrhea',
        ]);
    }

    private function medicament_types(){
        DB::table('medicament_types')->insert([
            'name' => 'pills',
        ]);
        DB::table('medicament_types')->insert([
            'name' => 'vitamins',
        ]);
        DB::table('medicament_types')->insert([
            'name' => 'gel',
        ]);
        DB::table('medicament_types')->insert([
            'name' => 'spray',
        ]);
    }

    private function specialities(){
        DB::table('specialities')->insert([
            'name' => 'dantist',
            'description' => 'have the right to treat teeth and oral cavity in the following manifestations - caries, periodontal disease, stomatitis'
        ]);
        DB::table('specialities')->insert([
            'name' => 'massagist',
            'description' => 'applies compression movements and deep kneading along the neck, shoulders and scalp'
        ]);
        DB::table('specialities')->insert([
            'name' => 'therapist',
            'description' => 'knowledge will allow therapist to complete a classification and provide appropriate treatment to a wide variety of diseases'
        ]);
    }

    private function symptoms(){
        DB::table('symptoms')->insert([
            'indication' => 'bloating',
        ]);
        DB::table('symptoms')->insert([
            'indication' => 'cought',
        ]);
        DB::table('symptoms')->insert([
            'indication' => 'diarrhea',
        ]);
        DB::table('symptoms')->insert([
            'indication' => 'dizziness',
        ]);
        DB::table('symptoms')->insert([
            'indication' => 'fatigue',
        ]);
        DB::table('symptoms')->insert([
            'indication' => 'fever',
        ]);
        DB::table('symptoms')->insert([
            'indication' => 'headache',
        ]);
        DB::table('symptoms')->insert([
            'indication' => 'muscle cramp',
        ]);
        DB::table('symptoms')->insert([
            'indication' => 'nausea',
        ]);
        DB::table('symptoms')->insert([
            'indication' => 'throat irritation',
        ]);
    }

    private function payments(){
        for ($i=1; $i<=15; $i++) {
            DB::table('payments')->insert([
                'payed_at' => $this->getRandomDate('2018-06-01 01:00:00', '2018-08-01 23:00:00'),
                'success' => rand(0,1),
            ]);
        }
    }

    // Find a randomized FIO
    private function getRandomFIO(){
        $firstname = ['Ivan', 'Egor', 'Petr', 'Alexey', 'Alexander', 'Vladimir', 'Sergey'];
        $lastname = ['Ivanovich', 'Egorovich', 'Petrovich', 'Alexeevich', 'Alexanderovich', 'Vladimirovich', 'Sergeevich'];
        $thirdname = ['Ivanov', 'Egorov', 'Petrov', 'Alexeev', 'Alexandrov', 'Vladimirov', 'Sergeev'];
        return $thirdname[rand(0,6)].' '.$firstname[rand(0,6)].' '.$lastname[rand(0,6)];
    }

    // Find a randomDate between $start_date and $end_date
    function getRandomDate($start_date, $end_date)
    {
        $min = strtotime($start_date);
        $max = strtotime($end_date);
        $val = rand($min, $max);
        return date('Y-m-d H:i:s', $val);
    }

    // Find a random speciality
    function getRandomSpeciality(){
        $specialities = ['dantist', 'massagist', 'therapist', 'urologist', 'ophthalmologist'];
        return $specialities[rand(0,4)];
    }

}
