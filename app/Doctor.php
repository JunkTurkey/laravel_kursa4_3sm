<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    public function cabinet()
    {
        return $this->hasMany('App/Cabinet');
    }

    public function speciality(){
        return $this->hasMany('App/Speciality');
    }

    public function getUserIdAttribute($value){
        return User::find($value);
    }

    public function getSpecialityIdAttribute($value){
        return Speciality::find($value);
    }

    public function getCabinetIdAttribute($value){
        return Cabinet::find($value);
    }

}
