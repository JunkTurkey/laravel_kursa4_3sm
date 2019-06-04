<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_doctor = Role::where('name', 'doctor')->first();
        $role_admin = Role::where('name', 'admin')->first();
        $role_patient = Role::where('name', 'patient')->first();

        $admin = new User();
        $admin->name = $this->getRandomFIO();
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('12345');
        $admin->save();
        $admin->roles()->attach($role_admin);

        for($i=0; $i<=14; $i++) {
            $randid = rand(0,9999);
            $doctor = new User();
            $doctor->name = $this->getRandomFIO();
            $doctor->email = $randid.'@example.com';
            $doctor->password = bcrypt($randid);
            $doctor->save();
            $doctor->roles()->attach($role_patient);
            $doctor->roles()->attach($role_doctor);
        }
        for($i=0; $i<=15; $i++){
            $randid = rand(0,9999);
            $patient = new User();
            $patient->name = $this->getRandomFIO();
            $patient->email = $randid.'@example.com';
            $patient->password = bcrypt($randid);
            $patient->save();
            $patient->roles()->attach($role_patient);
        }
    }

    private function getRandomFIO(){
        $firstname = ['Ivan', 'Egor', 'Petr', 'Alexey', 'Alexander', 'Vladimir', 'Sergey'];
        $lastname = ['Ivanovich', 'Egorovich', 'Petrovich', 'Alexeevich', 'Alexanderovich', 'Vladimirovich', 'Sergeevich'];
        $thirdname = ['Ivanov', 'Egorov', 'Petrov', 'Alexeev', 'Alexandrov', 'Vladimirov', 'Sergeev'];
        return $thirdname[rand(0,6)].' '.$firstname[rand(0,6)].' '.$lastname[rand(0,6)];
    }
}
