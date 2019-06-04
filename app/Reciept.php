<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reciept extends Model
{
    public $timestamps = false;

    public function payment(){
        return $this->hasMany(Payment::class);
    }

    public function medicaments(){
        return $this->belongsToMany(Medicament::class);
    }

    public function symptoms(){
        return $this->belongsToMany(Symptom::class);
    }
}
