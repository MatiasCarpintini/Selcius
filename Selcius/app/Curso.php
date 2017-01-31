<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;
class Curso extends Model
{
    public function user()
    {
        return $this->belongsTo('Selcius\User');
    }
    public function likes()
    {
        return $this->hasMany('Selcius\Like');
    }
    public function comentarios(){
    	return $this->hasMany('Selcius\Comentario');
    }
    public function section(){
        return $this->belongsTo('Selcius\Section');
    }
}
