<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function cursos(){
    	return $this->hasMany('Selcius\Curso');
    }
}
