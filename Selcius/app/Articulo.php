<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;
use Selcius\Auth;

class Articulo extends Model
{
    public function category()
    {
    	return $this->belongsTo('Selcius\Category');
    }

    public function tags()
    {
    	return $this->belongsToMany('Selcius\Tag');
    }
    public function comments()
    {
    	return $this->hasMany('Selcius\Comment');
    }
    public function user()
    {
        return $this->belongsTo('Selcius\User');
    }
    public function likes(){
        return $this->hasMany('Selcius\Like');
    }
    
}