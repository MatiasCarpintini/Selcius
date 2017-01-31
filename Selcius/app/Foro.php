<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;

class Foro extends Model
{
    public function user(){
        return $this->belongsTo('Selcius\User');
    }
    public function answers(){
        return $this->hasMany('Selcius\Answer');
    }
}
