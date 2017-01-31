<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function articulo()
    {
    	return $this->belongsTo('Selcius\Articulo');
    }
    public function answers()
    {
    	return $this->hasMany('Selcius\Comment');
    }
    public function user(){
    	return $this->belongsTo('Selcius\User');
    }
}
