<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospital extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Creation
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::create('doctors',function (Blueprint $table){
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedInteger('cabinet_id')->nullable();
            $table->unsignedInteger('speciality_id')->nullable();
            $table->string('phone');
        });
        Schema::create('specialities',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description');
        });
        Schema::create('cabinets',function (Blueprint $table){
            $table->increments('id');
            $table->integer('number');
            $table->string('name');
            $table->unsignedInteger('cabinet_type_id')->nullable();
        });
        Schema::create('cabinet_types',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('equipment',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('cabinet_type_id')->nullable();
            $table->unsignedInteger('equipment_type_id')->nullable();
        });
        Schema::create('equipment_types',function (Blueprint $table){
            $table->increments('id');
            $table->string('type');
        });
        Schema::create('appointments',function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('doctor_id')->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->dateTime('appointed_at');
            $table->unsignedInteger('status_id')->nullable();
            $table->unsignedInteger('appointment_type_id')->nullable();
        });
        Schema::create('statuses', function (Blueprint $table){
           $table->increments('id');
           $table->string('name');
        });
        Schema::create('appointment_types',function (Blueprint $table){
            $table->increments('id');
            $table->string('description');
        });
        Schema::create('reciepts',function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('payment_id')->nullable();
            $table->unsignedInteger('appointment_id')->nullable();
        });
        Schema::create('symptoms',function (Blueprint $table){
            $table->increments('id');
            $table->string('indication');
        });
        Schema::create('medicaments',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->unsignedInteger('medicament_type_id')->nullable();
            $table->string('testimony');
        });
        Schema::create('medicament_types',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
        });
        Schema::create('payments',function (Blueprint $table){
            $table->increments('id');
            $table->dateTime('payed_at');
            $table->boolean('success');
        });
        Schema::create('medicament_reciept', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('reciept_id');
            $table->unsignedInteger('medicament_id');
        });
        Schema::create('reciept_symptom', function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('reciept_id');
            $table->unsignedInteger('symptom_id');
        });
        //Foreigns
        Schema::table('doctors', function (Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('cabinet_id')->references('id')->on('cabinets');
            $table->foreign('speciality_id')->references('id')->on('specialities');
        });
        Schema::table('appointments', function (Blueprint $table){
            $table->foreign('doctor_id')->references('id')->on('doctors');
            $table->foreign('patient_id')->references('id')->on('users');
            $table->foreign('appointment_type_id')->references('id')->on('appointment_types');
            $table->foreign('status_id')->references('id')->on('statuses');
        });
        Schema::table('reciepts', function (Blueprint $table){
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('appointment_id')->references('id')->on('appointments');
        });
        Schema::table('medicaments', function (Blueprint $table){
            $table->foreign('medicament_type_id')->references('id')->on('medicament_types');
        });
        Schema::table('cabinets', function (Blueprint $table){
            $table->foreign('cabinet_type_id')->references('id')->on('cabinet_types');
        });
        Schema::table('equipment', function (Blueprint $table){
            $table->foreign('equipment_type_id')->references('id')->on('equipment_types');
            $table->foreign('cabinet_type_id')->references('id')->on('cabinet_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['cabinet_id']);
            $table->dropForeign(['speciality_id']);
        });
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['doctor_id']);
            $table->dropForeign(['patient_id']);
            $table->dropForeign(['appointment_type_id']);
            $table->dropForeign(['status_id']);
        });
        Schema::table('reciepts', function (Blueprint $table) {
            $table->dropForeign(['payment_id']);
            $table->dropForeign(['appointment_id']);
        });
        Schema::table('medicaments', function (Blueprint $table) {
            $table->dropForeign(['medicament_type_id']);
        });
        Schema::table('cabinets', function (Blueprint $table) {
            $table->dropForeign(['cabinet_type_id']);
        });
        Schema::table('equipment', function (Blueprint $table) {
            $table->dropForeign(['cabinet_type_id']);
            $table->dropForeign(['equipment_type_id']);
        });
        Schema::dropIfExists('users');
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('specialities');
        Schema::dropIfExists('cabinets');
        Schema::dropIfExists('cabinet_types');
        Schema::dropIfExists('equipment');
        Schema::dropIfExists('equipment_types');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('medicaments');
        Schema::dropIfExists('medicament_types');
        Schema::dropIfExists('symptoms');
        Schema::dropIfExists('reciepts');
        Schema::dropIfExists('appointment_types');
        Schema::dropIfExists('payments');
        Schema::dropIfExists('medicament_reciept');
        Schema::dropIfExists('reciept_symptom');
    }
}
