<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cabinet extends Model
{

    public function cabinet_type(){
        return $this->hasMany('App/Cabinet_type');
    }

    public function getCabinetTypeIdAttribute($value){
        return Cabinet_type::find($value);
    }

}
