<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    public function user()
    {
    	return $this->belongsTo('Selcius\User');
    }
    public function likes(){
    	return $this->HasMany('Selcius\Like');
    }
    public function messages(){
    	return $this->hasMany('Selcius\Message');
    }
}
