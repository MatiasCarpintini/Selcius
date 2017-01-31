<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    public function user()
    {
    	return $this->belongsTo('Selcius\User');
    }
    public function curso(){
    	return $this->belongsTo('Selcius\Curso');
    }
}
