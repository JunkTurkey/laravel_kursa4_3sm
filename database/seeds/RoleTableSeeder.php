<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_doctor = new Role();
        $role_doctor->name = 'doctor';
        $role_doctor->description = 'A Doctor User';
        $role_doctor->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'A Admin User';
        $role_admin->save();

        $role_patient = new Role();
        $role_patient->name = 'patient';
        $role_patient->description = 'A Patient User';
        $role_patient->save();
  }
}
