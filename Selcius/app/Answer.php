<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    public function user(){
        return $this->belongsTo('Selcius\User');
    }
    public function foro(){
        return $this->belongsTo('Selcius\Foro');
    }
}
