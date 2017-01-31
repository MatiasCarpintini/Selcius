<?php

namespace Selcius;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{ 
    public function user(){
    	return $this->belongsTo('Selcius\User');
    }
    public function upload(){
        return $this->belongsTo('Selcius\Upload');
    }
}
