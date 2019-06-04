<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    public $timestamps = false;

    public function doctor(){
        return $this->hasOne('App/Doctor');
    }

    public function patient(){
        return $this->hasOne('App/Patient');
    }

    public function appointment_type(){
        return $this->hasMany('App/Appointment_type');
    }

    public function getDoctorIdAttribute($value){
        return Doctor::find($value);
    }

    public function getPatientIdAttribute($value){
        return User::find($value);
    }

    public function getStatusIdAttribute($value){
        return Status::find($value);
    }

    public function getAppointmentTypeIdAttribute($value){
        return Appointment_type::find($value);
    }

}
