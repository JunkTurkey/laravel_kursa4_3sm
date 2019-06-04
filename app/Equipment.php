<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    public function cabinet_type(){
        return $this->belongsTo('App/Cabinet_type');
    }

    public function equipment_type(){
        return $this->hasMany('App/Equipment_type');
    }
}
