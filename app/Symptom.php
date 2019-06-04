<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = [
        'indication',
    ];

    public $timestamps = false;

    public function reciepts(){
        return $this->belongsToMany(Reciept::class);
    }
}
