<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicament extends Model
{
    public function reciepts(){
        return $this->belongsToMany(Reciept::class);
    }

    public function medicament_types(){
        return $this->hasMany(Medicament_type::class);
    }
}
